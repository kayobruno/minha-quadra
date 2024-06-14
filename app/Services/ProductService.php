<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\ProductRepository;
use App\DataTransferObjects\ProductData;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductService
{
    public function __construct(private readonly ProductRepository $productRepository)
    {
    }

    public function getAll(): Collection
    {
        return $this->productRepository->getAll();
    }

    public function paginate(): LengthAwarePaginator
    {
        return $this->productRepository->paginate();
    }

    public function save(ProductData $productData): Model
    {
        return $this->productRepository->save($productData);
    }

    public function update(string $id, ProductData $productData): Model
    {
        return $this->productRepository->update($id, $productData);
    }

    public function delete(string $id): void
    {
        $this->productRepository->delete($id);
    }
}
