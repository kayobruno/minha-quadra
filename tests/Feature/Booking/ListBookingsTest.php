<?php

declare(strict_types=1);

use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\DB;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

afterEach(function () {
    DB::table('bookings')->truncate();
    DB::table('users')->truncate();
});

test('it can list bookings', function () {
    Booking::factory()->count(10)->create();

    $response = $this->get('/bookings');

    $response->assertStatus(200);
    $response->assertViewIs('content.bookings.index');
    $response->assertSee('Cadastrar');
    $response->assertSee('Cliente');
    $response->assertSee('Quadra');
    $response->assertSee('Esporte');
    $response->assertSee('Data do Agendamento');
    $response->assertSee('Status');
    $response->assertSee('Agendado Por');
})->group('BookingController');

test('screen with empty list of reservations can be rendered', function () {
    $response = $this->get('/bookings');

    $response->assertStatus(200);
    $response->assertViewIs('content.bookings.index');
    $response->assertSee('Cadastrar');
    $response->assertSee('Nenhum Agendamento cadastrado!');
})->group('BookingController');
