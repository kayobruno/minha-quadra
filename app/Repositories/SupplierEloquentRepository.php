<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\DataParam;
use App\Contracts\SupplierRepository;
use App\Models\Supplier;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SupplierEloquentRepository implements SupplierRepository
{
    public function getAll(): Collection
    {
        return Supplier::all();
    }

    public function paginate(): LengthAwarePaginator
    {
        return Supplier::paginate();
    }

    public function findById(string $id): Model
    {
        return Supplier::whereId($id)->first();
    }

    public function save(DataParam $dataParam): Model
    {
        return Supplier::create($dataParam->toArray());
    }

    public function update(string $id, DataParam $dataParam): Model
    {
        $supplier = Supplier::whereId($id)->first();
        $supplier->update($dataParam->toArray());

        return $supplier;
    }

    public function delete(string $id): void
    {
        $supplier = Supplier::whereId($id)->first();
        $supplier->delete();
    }
}
