<?php

declare(strict_types=1);

use App\Http\Controllers\Api\BookingController;
use App\Models\Booking;
use App\Models\User;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\JsonResponse;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

afterEach(function () {
    Booking::truncate();
    User::truncate();
});

test('it returns an empty list when no bookings are registered', function () {
    $response = $this->get('/api/bookings');
    $bookings = json_decode($response->getContent(), true);

    expect($response->getStatusCode())->toBe(200);
    expect($bookings['data'])->toBeEmpty();
    $response->assertJsonStructure([
        'data' => [],
    ]);
});

test('it returns a list of bookings', function () {
    $now = Carbon::now();
    Booking::factory()->count(10)->create([
        'merchant_id' => $this->user->merchant_id,
        'start_datetime' => $now,
        'end_datetime' => $now->addHour(),
    ]);

    $response = $this->get('/api/bookings');

    $response->assertStatus(200);
    $response->assertJsonCount(10, 'data');
    $response->assertJsonStructure([
        'data' => [
            '*' => ['id', 'start', 'end', 'total_hours', 'status', 'court', 'customer', 'sport', 'note'],
        ],
    ]);
});

test('it returns an empty list when the route is unavailable', function () {
    $request = Mockery::mock(Request::class);
    $request->shouldReceive('input')->andReturn('');

    $bookingService = Mockery::mock(BookingService::class);
    $bookingService->shouldReceive('getBookingsBetweenDates')->andThrow(new \Exception('Simulated exception'));

    $controller = new BookingController();
    $response = $controller->index($request, $bookingService);

    expect($response)->toBeInstanceOf(JsonResponse::class);
    expect($response->getStatusCode())->toBe(503);

    $responseData = $response->getData(true);
    expect($responseData['success'])->toBe(false);
    expect($responseData['message'])->toBe(__('messages.errors.unavailable'));
});
