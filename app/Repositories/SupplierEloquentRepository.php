<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\DataParam;
use App\Contracts\SupplierRepository;
use App\Models\Supplier;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SupplierEloquentRepository implements SupplierRepository
{
    public function __construct(private readonly Supplier $model)
    {
    }

    public function getAll(): Collection
    {
        return $this->model::all();
    }

    public function paginate(): LengthAwarePaginator
    {
        return $this->model::paginate();
    }

    public function findById(string $id): Supplier
    {
        return $this->model::whereId($id)->first();
    }

    public function save(DataParam $dataParam): Supplier
    {
        return $this->model::create($dataParam->toArray());
    }

    public function update(string $id, DataParam $dataParam): Supplier
    {
        $supplier = $this->model::whereId($id)->first();
        $supplier->update($dataParam->toArray());

        return $supplier;
    }

    public function delete(string $id): void
    {
        $supplier = $this->model::whereId($id)->first();
        $supplier->delete();
    }
}
