<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\DataParam;
use App\Contracts\ProductRepository;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProductEloquentRepository implements ProductRepository
{
    public function __construct(private readonly Product $model)
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

    public function findById(string $id): Product
    {
        return $this->model::whereId($id)->first();
    }

    public function save(DataParam $dataParam): Product
    {
        return $this->model::create($dataParam->toArray());
    }

    public function update(string $id, DataParam $dataParam): Product
    {
        $product = $this->model::whereId($id)->first();
        $product->update($dataParam->toArray());

        return $product;
    }

    public function delete(string $id): void
    {
        $product = $this->model::whereId($id)->first();
        $product->delete();
    }
}
