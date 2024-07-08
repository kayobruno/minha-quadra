<?php

declare(strict_types=1);

use App\Enums\BookingStatus;
use App\Enums\Sport;
use App\Http\Controllers\Api\BookingController;
use App\Models\Booking;
use App\Models\Court;
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
    Court::truncate();
});

it('returns an empty list when there are no bookings', function () {
    $response = $this->get('/api/bookings');
    $bookings = json_decode($response->getContent(), true);

    expect($response->getStatusCode())->toBe(200);
    expect($bookings['data'])->toBeEmpty();
    $response->assertJsonStructure([
        'data' => [],
    ]);
});

it('returns a list of bookings', function () {
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

it('returns service is unavailable', function () {
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

it('can show a single booking', function () {
    $booking = Booking::factory()->create();

    $response = $this->get('/api/bookings/' . $booking->id);

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'data' => ['id', 'start', 'end', 'total_hours', 'status', 'court', 'customer', 'sport', 'note'],
    ]);
});

it('can not cancel a booking when date is past', function () {
    $yesterday = Carbon::yesterday();
    $booking = Booking::factory()->create([
        'status' => BookingStatus::Confirm->value,
        'start_datetime' => $yesterday,
        'end_datetime' => $yesterday->addHour(),
    ]);

    $response = $this->get('/api/bookings/' . $booking->id . '/cancel');

    $response->assertStatus(400);
    $response->assertJsonFragment([
        'success' => false,
        'data' => [
            'error' => [__('messages.validation.notallowed')],
        ],
    ]);
    $response->assertJsonStructure([
        'data' => ['error'],
    ]);
});

it('can not cancel a booking when status is different from Confirm and Progress', function (string $status) {
    $now = Carbon::now();
    $booking = Booking::factory()->create([
        'status' => $status,
        'start_datetime' => $now,
        'end_datetime' => $now->addHour(),
    ]);

    $response = $this->get('/api/bookings/' . $booking->id . '/cancel');

    $response->assertStatus(400);
    $response->assertJsonFragment([
        'success' => false,
        'data' => [
            'error' => [__('messages.validation.notallowed')],
        ],
    ]);
    $response->assertJsonStructure([
        'data' => ['error'],
    ]);
})->with([
    'Canceled' => BookingStatus::Canceled->value,
    'Finished' => BookingStatus::Finished->value,
]);

it('can cancel a booking', function () {
    $now = Carbon::now();
    $booking = Booking::factory()->create([
        'status' => BookingStatus::Confirm->value,
        'start_datetime' => $now,
        'end_datetime' => $now->addHour(),
    ]);

    $response = $this->get('/api/bookings/' . $booking->id . '/cancel');

    $response->assertStatus(200);
    $response->assertJsonFragment([
        'success' => true,
        'status' => BookingStatus::Canceled,
    ]);
    $response->assertJsonStructure([
        'data' => ['id', 'start', 'end', 'total_hours', 'status', 'court', 'customer', 'sport', 'note'],
    ]);
});

it('can create booking', function () {
    $court = Court::factory()->create();
    $now = Carbon::now();
    $now->addHour();
    $startTime = $now->format('H:i');
    $now->addHours(2);
    $endTime = $now->format('H:i');

    $response = $this->post('/api/bookings', [
        'court_id' => $court->id,
        'name' => 'Fake Name',
        'phone' => 'Fake Phone',
        'when' => $now->format('Y-m-d'),
        'start_time' => $startTime,
        'end_time' => $endTime,
        'sport' => Sport::Volleyball->value,
        'note' => 'fake note',
    ]);

    $response->assertStatus(200);
    $response->assertJsonFragment([
        'success' => true,
    ]);
    $response->assertJsonStructure([
        'data' => ['id', 'start', 'end', 'total_hours', 'status', 'court', 'customer', 'sport', 'note'],
    ]);
});

it('can not create a booking when required fields are empty', function () {
    $response = $this->post('/api/bookings', []);

    $response->assertStatus(400);
    $response->assertJsonFragment([
        'success' => false,
    ]);
    $response->assertJsonStructure([
        'data' => [
            'court_id', 'name', 'when', 'start_time', 'end_time', 'sport',
        ],
    ]);
});

it('can not create booking when date is past', function () {
    $court = Court::factory()->create();
    $yesterday = Carbon::yesterday();
    $response = $this->post('/api/bookings', [
        'court_id' => $court->id,
        'name' => 'Fake Name',
        'phone' => 'Fake Phone',
        'when' => $yesterday->format('Y-m-d'),
        'start_time' => $yesterday->addHour()->format('H:i'),
        'end_time' => $yesterday->addHour()->format('H:i'),
        'sport' => Sport::Volleyball->value,
        'note' => 'fake note',
    ]);

    $response->assertStatus(400);
    $response->assertJsonFragment([
        'success' => false,
    ]);
    $response->assertJsonStructure([
        'data' => [
            'when',
        ],
    ]);
});
