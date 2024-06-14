<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\MerchantRepository;
use App\DataTransferObjects\MerchantData;
use Illuminate\Database\Eloquent\Model;

class MerchantService
{
    public function __construct(private MerchantRepository $merchantRepository)
    {
    }

    public function save(MerchantData $merchantData): Model
    {
        return $this->merchantRepository->save($merchantData);
    }

    public function update(string $id, MerchantData $merchantData): Model
    {
        return $this->merchantRepository->update($id, $merchantData);
    }

    public function delete(string $id): void
    {
        $this->merchantRepository->delete($id);
    }
}
