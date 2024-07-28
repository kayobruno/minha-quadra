<?php

use App\Contracts\ProductRepository;
use App\DataTransferObjects\ProductData;
use App\Services\ProductService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

beforeEach(function () {
    $this->productRepository = Mockery::mock(ProductRepository::class);
    $this->productService = new ProductService($this->productRepository);
});

afterEach(function () {
    Mockery::close();
});

it('retrieves all products', function () {
    $products = Mockery::mock(Collection::class);
    $this->productRepository
        ->shouldReceive('getAll')
        ->once()
        ->andReturn($products);

    $result = $this->productService->getAll();
    expect($result)->toBe($products);
});

it('paginates products', function () {
    $paginator = Mockery::mock(LengthAwarePaginator::class);
    $this->productRepository
        ->shouldReceive('paginate')
        ->once()
        ->andReturn($paginator);

    $result = $this->productService->paginate();
    expect($result)->toBe($paginator);
});

it('saves a product', function () {
    $productData = Mockery::mock(ProductData::class);
    $savedProduct = Mockery::mock(Model::class);
    $this->productRepository
        ->shouldReceive('save')
        ->with($productData)
        ->once()
        ->andReturn($savedProduct);

    $result = $this->productService->save($productData);
    expect($result)->toBe($savedProduct);
});

it('updates a product', function () {
    $productData = Mockery::mock(ProductData::class);
    $updatedProduct = Mockery::mock(Model::class);
    $id = 'product123';
    $this->productRepository
        ->shouldReceive('update')
        ->with($id, $productData)
        ->once()
        ->andReturn($updatedProduct);

    $result = $this->productService->update($id, $productData);
    expect($result)->toBe($updatedProduct);
});

it('deletes a product', function () {
    $id = 'product123';
    $this->productRepository
        ->shouldReceive('delete')
        ->with($id)
        ->once();

    $this->productService->delete($id);
    expect(true)->toBeTrue();
});
