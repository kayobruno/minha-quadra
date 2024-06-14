<?php

declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\SupplierData;
use App\Repositories\SupplierEloquentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SupplierService
{
    public function __construct(private readonly SupplierEloquentRepository $supplierRepository)
    {
    }

    public function getAll(): Collection
    {
        return $this->supplierRepository->getAll();
    }

    public function paginate(): LengthAwarePaginator
    {
        return $this->supplierRepository->paginate();
    }

    public function save(SupplierData $supplierData): Model
    {
        return $this->supplierRepository->save($supplierData);
    }

    public function update(string $id, SupplierData $supplierData): Model
    {
        return $this->supplierRepository->update($id, $supplierData);
    }

    public function delete(string $id): void
    {
        $this->supplierRepository->delete($id);
    }
}
