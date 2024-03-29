<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\BookingRepository;
use App\Contracts\DataParam;
use App\DataTransferObjects\BookingDataParam;
use App\DataTransferObjects\BookingFilter;
use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Traits\ToArray;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BookingService
{
    public function __construct(private BookingRepository $bookingRepository)
    {
    }

    public function findById(string $bookingId): Model
    {
        return $this->bookingRepository->findById($bookingId);
    }

    public function createBooking(BookingDataParam $bookingDataParam): Booking
    {
        return $this->bookingRepository->save($bookingDataParam);
    }

    public function updateBooking(BookingDataParam $bookingDataParam, string $bookingId): Booking
    {
        $booking = $this->findById($bookingId);
        if (!$this->canUpdateBooking($booking)) {
            throw new \LogicException(__('messages.validation.notallowed'));
        }

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

    public function cancelBooking(string $bookingId): void
    {
        $bookingCancelData = new class(BookingStatus::Canceled->value) implements DataParam {
            use ToArray;

            public function __construct(public string $status)
            {
            }
        };

        $this->bookingRepository->update($bookingId, $bookingCancelData);
    }

    public function canUpdateBooking(Booking $booking): bool
    {
        $isBookingInThePast = $booking->start_datetime < (new \DateTime());

        return $booking->status->isEditable() && $isBookingInThePast === false;
    }
}
