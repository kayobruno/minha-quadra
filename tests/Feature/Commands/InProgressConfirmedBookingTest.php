<?php

declare(strict_types=1);

use App\Enums\BookingStatus;
use App\Models\Booking;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

afterEach(function () {
    DB::table('bookings')->truncate();
});

test('execute command without errors', function () {
    Artisan::call('app:progress-confirmed-booking');

    $this->assertEmpty(Artisan::output());
});

it('updates statuses to in progress', function () {
    $booking1 = Booking::factory()->create(['status' => BookingStatus::Pending, 'start_datetime' => now()->subDays(1)]);
    $booking2 = Booking::factory()->create(['status' => BookingStatus::Pending, 'start_datetime' => now()->subHours(1)]);
    $booking3 = Booking::factory()->create(['status' => BookingStatus::Confirm, 'start_datetime' => now()->subHours(1)]);

    Artisan::call('app:progress-confirmed-booking');

    expect($booking1->refresh()->status)->toBe(BookingStatus::Pending);
    expect($booking2->refresh()->status)->not->toBe(BookingStatus::Progress);
    expect($booking3->refresh()->status)->toBe(BookingStatus::Progress);
});
