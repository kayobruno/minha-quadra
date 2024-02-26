<?php

declare(strict_types=1);

use App\Enums\BookingStatus;
use App\Enums\Sport;
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

test('the booking registration form screen can be rendered', function () {
    $response = $this->get('/bookings/create');

    $response->assertStatus(200);
    $response->assertViewIs('content.bookings.create');
    $response->assertSee('Cliente');
    $response->assertSee('Quadra');
    $response->assertSee('Modalidade');
    $response->assertSee('Data e Horário de Início');
    $response->assertSee('Horário final');
    $response->assertSee('Status');
    $response->assertSee('Salvar');
})->group('BookingController');

test('validates required fields when creating a new booking', function () {
    $response = $this->post('/bookings/store', []);

    $response->assertSessionHasErrors(['customer_id', 'court_id', 'sport', 'start_datetime']);
})->group('BookingController');

// TODO: Fix
// test('can create a new booking', function () {
//     $customer = Customer::factory()->create();
//     $court = Court::factory()->create();
//     $startDatetime = (Carbon::now())->addDay();

//     $data = [
//         'customer_id' => $customer->id,
//         'court_id' => $court->id,
//         'sport' => Sport::Volleyball->value,
//         'start_datetime' => $startDatetime,
//         'end_datetime' => (Carbon::parse($startDatetime))->addHours(2),
//         'status' => BookingStatus::Confirm->value,
//     ];
//     $response = $this->post('/bookings/store', $data);

//     $response->assertStatus(302);
//     $response->assertSee('Redirecting to');
//     $this->assertDatabaseHas('bookings', $data);
// })->group('BookingController');

// test('validate date in the past', function () {
//     $customer = Customer::factory()->create();
//     $court = Court::factory()->create();
//     $startDatetime = (Carbon::now())->subDay();

//     $data = [
//         'customer_id' => $customer->id,
//         'court_id' => $court->id,
//         'sport' => Sport::Volleyball->value,
//         'start_datetime' => $startDatetime,
//         'end_datetime' => (Carbon::parse($startDatetime))->addHours(2),
//         'status' => BookingStatus::Confirm->value,
//     ];
//     $response = $this->post('/bookings/store', $data);

//     $response->assertSessionHasErrors(['start_datetime']);
// })->group('BookingController');
