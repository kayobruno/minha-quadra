<?php

declare(strict_types=1);

use App\Contracts\DataParam;
use App\Models\Product;
use App\Repositories\ProductEloquentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

beforeEach(function () {
    $this->productMock = Mockery::mock(Product::class);
    $this->productRepository = new ProductEloquentRepository($this->productMock);
});

afterEach(function () {
    Mockery::close();
});

test('getAll returns a collection of products', function () {
    $this->productMock->shouldReceive('all')->once()->andReturn(new Collection());

    $result = $this->productRepository->getAll();

    expect($result)->toBeInstanceOf(Collection::class);
});

test('paginate returns a LengthAwarePaginator', function () {
    $paginatorMock = Mockery::mock(LengthAwarePaginator::class);
    $this->productMock->shouldReceive('paginate')->once()->andReturn($paginatorMock);

    $result = $this->productRepository->paginate();

    expect($result)->toBeInstanceOf(LengthAwarePaginator::class);
});

test('findById returns a product when found', function () {
    $this->productMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->productMock->shouldReceive('first')->once()->andReturn($this->productMock);

    $result = $this->productRepository->findById('1');

    expect($result)->toBeInstanceOf(Product::class);
});

test('save creates and returns a new product', function () {
    $dataParamMock = Mockery::mock(DataParam::class);
    $dataParamMock->shouldReceive('toArray')->once()->andReturn(['foo' => 'bar']);
    $this->productMock->shouldReceive('create')->with(['foo' => 'bar'])->once()->andReturn($this->productMock);

    $result = $this->productRepository->save($dataParamMock);

    expect($result)->toBeInstanceOf(Product::class);
});

test('update updates and returns the product', function () {
    $dataParamMock = Mockery::mock(DataParam::class);
    $dataParamMock->shouldReceive('toArray')->once()->andReturn(['foo' => 'bar']);
    $this->productMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->productMock->shouldReceive('first')->once()->andReturn($this->productMock);
    $this->productMock->shouldReceive('update')->with(['foo' => 'bar'])->once();

    $result = $this->productRepository->update('1', $dataParamMock);

    expect($result)->toBeInstanceOf(Product::class);
});

test('delete deletes the product', function () {
    $this->productMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->productMock->shouldReceive('first')->once()->andReturn($this->productMock);
    $this->productMock->shouldReceive('delete')->once();

    $this->productRepository->delete('1');

    expect(true)->toBeTrue();
});
