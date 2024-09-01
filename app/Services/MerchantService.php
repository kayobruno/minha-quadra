<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\MerchantRepository;
use App\DataTransferObjects\MerchantData;
use App\Models\Merchant;
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

    public function updateOrCreateConfigs(Merchant $merchant, array $configs): void
    {
        foreach ($configs as $configName => $configValue) {
            $this->merchantRepository->updateOrCreateConfig($merchant->id, $configName, $configValue);
        }
    }

    public function delete(string $id): void
    {
        $this->merchantRepository->delete($id);
    }
}
