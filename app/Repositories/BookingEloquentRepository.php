<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\BookingRepository;
use App\Contracts\DataParam;
use App\DataTransferObjects\BookingFilter;
use App\Enums\BookingStatus;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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

    public function hasConflictBetweenBookings(BookingFilter $bookingFilter): bool
    {
        return Booking::where('court_id', $bookingFilter->courtId)
            ->when($bookingFilter->bookingId, function ($query) use ($bookingFilter) {
                return $query->where('id', '!=', $bookingFilter->bookingId);
            })
            ->where('merchant_id', $bookingFilter->merchantId)
            ->where(function ($query) use ($bookingFilter) {
                $query->where(function ($q) use ($bookingFilter) {
                    $q->where('start_datetime', '<=', $bookingFilter->startDatetime)
                    ->where('end_datetime', '>', $bookingFilter->startDatetime);
                })
                ->orWhere(function ($q) use ($bookingFilter) {
                    $q->where('start_datetime', '<', $bookingFilter->endDatetime)
                        ->where('end_datetime', '>=', $bookingFilter->endDatetime);
                })
                ->orWhere(function ($q) use ($bookingFilter) {
                    $q->where('start_datetime', '>=', $bookingFilter->startDatetime)
                        ->where('end_datetime', '<=', $bookingFilter->endDatetime);
                });
            })
            ->whereNotIn('status', [BookingStatus::Canceled->value, BookingStatus::Finished->value])
            ->exists();
    }

    public function getBookingsBetweenDates(string $starDate, string $endDate): Collection
    {
        return Booking::with('customer', 'user', 'court')
            ->where('merchant_id', auth()->user()->merchant_id)
            ->where('start_datetime', '>=', $starDate)
            ->where('end_datetime', '<=', $endDate)
            ->orderBy('start_datetime', 'asc')
            ->get();
    }
}
