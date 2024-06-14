<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\DataParam;
use App\Contracts\MerchantRepository;
use App\Models\Merchant;
use Illuminate\Database\Eloquent\Model;

class MerchantEloquentRepository implements MerchantRepository
{
    public function save(DataParam $dataParam): Model
    {
        return Merchant::create($dataParam->toArray());
    }

    public function update(string $id, DataParam $dataParam): Model
    {
        $booking = Merchant::whereId($id)->first();
        $booking->update($dataParam->toArray());

        return $booking;
    }

    public function delete(string $id): void
    {
        $booking = Merchant::whereId($id)->first();
        $booking->delete();
    }
}
