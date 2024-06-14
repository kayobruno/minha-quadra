<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\DataParam;
use App\Contracts\ProductRepository;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductEloquentRepository implements ProductRepository
{
    public function getAll(): Collection
    {
        return Product::all();
    }

    public function paginate(): LengthAwarePaginator
    {
        return Product::paginate();
    }

    public function findById(string $id): Model
    {
        return Product::whereId($id)->first();
    }

    public function save(DataParam $dataParam): Model
    {
        return Product::create($dataParam->toArray());
    }

    public function update(string $id, DataParam $dataParam): Model
    {
        $product = Product::whereId($id)->first();
        $product->update($dataParam->toArray());

        return $product;
    }

    public function delete(string $id): void
    {
        $product = Product::whereId($id)->first();
        $product->delete();
    }
}
