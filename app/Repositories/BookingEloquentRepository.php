<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\BookingRepository;
use App\Contracts\DataParam;
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
}
