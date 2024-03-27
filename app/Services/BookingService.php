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
        return Booking::where('court_id', $bookingDataParam->courtId)
            ->where('merchant_id', $bookingDataParam->merchantId)
            ->where(function ($query) use ($bookingDataParam) {
                $query->where(function ($q) use ($bookingDataParam) {
                    $q->where('start_datetime', '<=', $bookingDataParam->startDatetime)
                    ->where('end_datetime', '>', $bookingDataParam->startDatetime);
                })
                ->orWhere(function ($q) use ($bookingDataParam) {
                    $q->where('start_datetime', '<', $bookingDataParam->endDatetime)
                        ->where('end_datetime', '>=', $bookingDataParam->endDatetime);
                })
                ->orWhere(function ($q) use ($bookingDataParam) {
                    $q->where('start_datetime', '>=', $bookingDataParam->startDatetime)
                        ->where('end_datetime', '<=', $bookingDataParam->endDatetime);
                });
            })
            ->exists();
    }

    public function getBookingsBetweenDates(string $starDate, string $endDate): Collection
    {
        return Booking::with('customer', 'user', 'court')
            ->where('merchant_id', '1') // TODO: Get from user logged
            ->where('start_datetime', '>=', $starDate)
            ->where('end_datetime', '<=', $endDate)
            ->orderBy('start_datetime', 'asc')
            ->get();
    }
}
