<?php

declare(strict_types=1);

use App\Enums\BookingStatus;
use App\Enums\Sport;
use App\Models\Booking;
use App\Models\Court;
use App\Models\Customer;
use App\Models\User;

afterEach(function () {
    User::truncate();
    Customer::truncate();
    Court::truncate();
    Booking::truncate();
});

it('can create a booking', function () {
    $user = User::factory()->create();
    $customer = Customer::factory()->create();
    $court = Court::factory()->create();

    $booking = Booking::factory()->create([
        'user_id' => $user->id,
        'customer_id' => $customer->id,
        'court_id' => $court->id,
        'sport' => Sport::Volleyball,
        'start_datetime' => now(),
        'end_datetime' => now()->addHour(),
        'total_hours' => 1,
        'note' => 'Test booking note',
        'status' => BookingStatus::Confirm,
    ]);

    expect($booking)->toBeInstanceOf(Booking::class);
    expect($booking->sport)->toBe(Sport::Volleyball);
    expect($booking->status)->toBe(BookingStatus::Confirm);
    expect($booking->user->id)->toBe($user->id);
    expect($booking->customer->id)->toBe($customer->id);
    expect($booking->court->id)->toBe($court->id);
});

it('can access related models', function () {
    $user = User::factory()->create();
    $customer = Customer::factory()->create();
    $court = Court::factory()->create();

    $booking = Booking::factory()->create([
        'user_id' => $user->id,
        'customer_id' => $customer->id,
        'court_id' => $court->id,
        'sport' => Sport::Footvolley,
        'start_datetime' => now(),
        'end_datetime' => now()->addHour(),
        'total_hours' => 1,
        'note' => 'Test booking note',
        'status' => BookingStatus::Progress,
    ]);

    $relatedUser = $booking->user;
    $relatedCustomer = $booking->customer;
    $relatedCourt = $booking->court;

    expect($relatedUser)->toBeInstanceOf(User::class);
    expect($relatedCustomer)->toBeInstanceOf(Customer::class);
    expect($relatedCourt)->toBeInstanceOf(Court::class);
});
