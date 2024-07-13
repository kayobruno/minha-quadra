<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\DataParam;
use App\Contracts\MerchantRepository;
use App\Models\Merchant;

class MerchantEloquentRepository implements MerchantRepository
{
    public function __construct(private readonly Merchant $model)
    {
    }

    public function save(DataParam $dataParam): Merchant
    {
        return $this->model::create($dataParam->toArray());
    }

    public function update(string $id, DataParam $dataParam): Merchant
    {
        $merchant = $this->model::whereId($id)->first();
        $merchant->update($dataParam->toArray());

        return $merchant;
    }

    public function delete(string $id): void
    {
        $merchant = $this->model::whereId($id)->first();
        $merchant->delete();
    }
}
