<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\BookingRepository;
use App\DataTransferObjects\BookingDataParam;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;

class BookingService
{
    public function __construct(private BookingRepository $bookingRepository)
    {
    }

    public function createBooking(BookingDataParam $bookingDataParam): Booking
    {
        return $this->bookingRepository->save($bookingDataParam);
    }

    public function hasConflictBetweenBookings(BookingDataParam $bookingDataParam): bool
    {
        return $this->bookingRepository->hasConflictBetweenBookings($bookingDataParam);
    }

    public function getBookingsBetweenDates(string $starDate, string $endDate): Collection
    {
        return $this->bookingRepository->getBookingsBetweenDates($starDate, $endDate);
    }
}
