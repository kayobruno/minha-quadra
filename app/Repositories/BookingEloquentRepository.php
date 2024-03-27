<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Booking;
use App\Contracts\DataParam;
use App\Contracts\BookingRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\DataTransferObjects\BookingDataParam;

class BookingEloquentRepository implements BookingRepository
{
    public function getAll(): Collection
    {
        return Booking::all();
    }

    public function findById(string $id): Model
    {
        return Booking::whereId($id)->first();
    }

    public function save(DataParam $dataParam): Model
    {
        return Booking::create($dataParam->toArray());
    }

    public function update(string $id, DataParam $dataParam): Model
    {
        $booking = Booking::whereId($id)->first();
        $booking->update($dataParam->toArray());

        return $booking;
    }

    public function delete(string $id): void
    {
        $booking = Booking::whereId($id)->first();
        $booking->delete();
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
