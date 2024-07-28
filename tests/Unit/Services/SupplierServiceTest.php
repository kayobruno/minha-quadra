<?php

declare(strict_types=1);

use App\DataTransferObjects\SupplierData;
use App\Models\Supplier;
use App\Repositories\SupplierEloquentRepository;
use App\Services\SupplierService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

beforeEach(function () {
    $this->supplierRepository = Mockery::mock(SupplierEloquentRepository::class);
    $this->supplierService = new SupplierService($this->supplierRepository);
});

afterEach(function () {
    Mockery::close();
});

it('gets all suppliers', function () {
    $collection = Mockery::mock(Collection::class);

    $this->supplierRepository->shouldReceive('getAll')
        ->once()
        ->andReturn($collection);

    $result = $this->supplierService->getAll();

    expect($result)->toBe($collection);
});

it('paginates suppliers', function () {
    $paginator = Mockery::mock(LengthAwarePaginator::class);

    $this->supplierRepository->shouldReceive('paginate')
        ->once()
        ->andReturn($paginator);

    $result = $this->supplierService->paginate();

    expect($result)->toBe($paginator);
});

it('saves a supplier', function () {
    $supplierData = Mockery::mock(SupplierData::class);
    $supplier = Mockery::mock(Supplier::class);

    $this->supplierRepository->shouldReceive('save')
        ->once()
        ->with($supplierData)
        ->andReturn($supplier);

    $result = $this->supplierService->save($supplierData);

    expect($result)->toBe($supplier);
});

it('updates a supplier', function () {
    $supplierData = Mockery::mock(SupplierData::class);
    $supplier = Mockery::mock(Supplier::class);

    $this->supplierRepository->shouldReceive('update')
        ->once()
        ->with('1', $supplierData)
        ->andReturn($supplier);

    $result = $this->supplierService->update('1', $supplierData);

    expect($result)->toBe($supplier);
});

it('deletes a supplier', function () {
    $this->supplierRepository->shouldReceive('delete')
        ->once()
        ->with('1');

    $this->supplierService->delete('1');

    $this->assertTrue(true);
});
