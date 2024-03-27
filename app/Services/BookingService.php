<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\BookingRepository;
use App\DataTransferObjects\BookingDataParam;
use App\DataTransferObjects\BookingFilter;
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

    public function updateBooking(BookingDataParam $bookingDataParam, string $bookingId): Booking
    {
        return $this->bookingRepository->update($bookingId, $bookingDataParam);
    }

    public function hasConflictBetweenBookings(BookingFilter $bookingFilter): bool
    {
        return $this->bookingRepository->hasConflictBetweenBookings($bookingFilter);
    }

    public function getBookingsBetweenDates(string $starDate, string $endDate): Collection
    {
        return $this->bookingRepository->getBookingsBetweenDates($starDate, $endDate);
    }
}
