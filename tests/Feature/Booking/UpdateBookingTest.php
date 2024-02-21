<?php

declare(strict_types=1);

use App\Enums\BookingStatus;
use App\Enums\Sport;
use App\Models\Booking;
use App\Models\Court;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

afterEach(function () {
    DB::table('bookings')->truncate();
    DB::table('users')->truncate();
});

test('the product update form screen can be rendered', function () {
    $product = Booking::factory()->create();

    $response = $this->get('bookings/' . $product->id);

    $response->assertStatus(200);
    $response->assertViewIs('content.bookings.edit');
    $response->assertSee('Cliente');
    $response->assertSee('Quadra');
    $response->assertSee('Modalidade');
    $response->assertSee('Data e Horário de Início');
    $response->assertSee('Horário final');
    $response->assertSee('Status');
    $response->assertSee('Salvar');
})->group('BookingController');

test('update a booking', function () {
    $booking = Booking::factory()->create();

    $customer = Customer::factory()->create();
    $court = Court::factory()->create();
    $startDatetime = (Carbon::now())->addDay();

    $newAttributes = [
        'customer_id' => $customer->id,
        'court_id' => $court->id,
        'sport' => Sport::Volleyball->value,
        'start_datetime' => $startDatetime,
        'end_datetime' => (Carbon::parse($startDatetime))->addHours(3),
        'status' => BookingStatus::Confirm->value,
    ];

    $this->put('bookings/' . $booking->id . '/update', $newAttributes);

    $this->assertDatabaseHas('bookings', $newAttributes);
})->group('BookingController');

test('attempt to update a non-existing booking', function () {
    $newAttributes = [
        'sport' => Sport::BeachTennis->value,
    ];

    $response = $this->put('/bookings/999/update', $newAttributes);

    $response->assertStatus(404);
    $this->assertDatabaseMissing('bookings', $newAttributes);
})->group('BookingController');
