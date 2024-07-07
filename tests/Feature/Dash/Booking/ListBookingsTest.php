<?php

declare(strict_types=1);

use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\DB;

afterEach(function () {
    DB::table('bookings')->truncate();
    DB::table('users')->truncate();
});

it('can list bookings', function () {
    Booking::factory()->count(10)->create();

    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/bookings');

    $response->assertStatus(200);
    $response->assertViewIs('content.bookings.index');
})->group('BookingController');
