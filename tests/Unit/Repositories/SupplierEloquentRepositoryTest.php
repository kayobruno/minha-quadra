<?php

declare(strict_types=1);

use App\Contracts\DataParam;
use App\Models\Supplier;
use App\Repositories\SupplierEloquentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

beforeEach(function () {
    $this->supplierMock = Mockery::mock(Supplier::class);
    $this->supplierRepository = new SupplierEloquentRepository($this->supplierMock);
});

afterEach(function () {
    Mockery::close();
});

test('getAll returns a collection of suppliers', function () {
    $this->supplierMock->shouldReceive('all')->once()->andReturn(new Collection());

    $result = $this->supplierRepository->getAll();

    expect($result)->toBeInstanceOf(Collection::class);
});

test('paginate returns a LengthAwarePaginator', function () {
    $paginatorMock = Mockery::mock(LengthAwarePaginator::class);
    $this->supplierMock->shouldReceive('paginate')->once()->andReturn($paginatorMock);

    $result = $this->supplierRepository->paginate();

    expect($result)->toBeInstanceOf(LengthAwarePaginator::class);
});

test('findById returns a model when found', function () {
    $this->supplierMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->supplierMock->shouldReceive('first')->once()->andReturn($this->supplierMock);

    $result = $this->supplierRepository->findById('1');

    expect($result)->toBeInstanceOf(Supplier::class);
});

test('save creates and returns a new supplier', function () {
    $dataParamMock = Mockery::mock(DataParam::class);
    $dataParamMock->shouldReceive('toArray')->once()->andReturn(['foo' => 'bar']);
    $this->supplierMock->shouldReceive('create')->with(['foo' => 'bar'])->once()->andReturn($this->supplierMock);

    $result = $this->supplierRepository->save($dataParamMock);

    expect($result)->toBeInstanceOf(Supplier::class);
});

test('update updates and returns the supplier', function () {
    $dataParamMock = Mockery::mock(DataParam::class);
    $dataParamMock->shouldReceive('toArray')->once()->andReturn(['foo' => 'bar']);
    $this->supplierMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->supplierMock->shouldReceive('first')->once()->andReturn($this->supplierMock);
    $this->supplierMock->shouldReceive('update')->with(['foo' => 'bar'])->once();

    $result = $this->supplierRepository->update('1', $dataParamMock);

    expect($result)->toBeInstanceOf(Supplier::class);
});

test('delete deletes the supplier', function () {
    $this->supplierMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->supplierMock->shouldReceive('first')->once()->andReturn($this->supplierMock);
    $this->supplierMock->shouldReceive('delete')->once();

    $this->supplierRepository->delete('1');

    expect(true)->toBeTrue();
});
