<?php

declare(strict_types=1);

use App\DataTransferObjects\InvoiceDataParam;
use App\Models\Invoice;
use App\Repositories\InvoiceEloquentRepository;
use App\Services\InvoiceService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

beforeEach(function () {
    $this->invoiceMock = Mockery::mock(Invoice::class);
    $this->repositoryMock = Mockery::mock(InvoiceEloquentRepository::class);
    $this->invoiceService = new InvoiceService($this->repositoryMock);
});

afterEach(function () {
    Mockery::close();
});

test('getAll returns a collection', function () {
    $this->repositoryMock->shouldReceive('getAll')->once()->andReturn(new Collection());

    $result = $this->invoiceService->getAll();

    expect($result)->toBeInstanceOf(Collection::class);
});

test('paginate returns a LengthAwarePaginator', function () {
    $paginatorMock = Mockery::mock(LengthAwarePaginator::class);
    $this->repositoryMock->shouldReceive('paginate')->once()->andReturn($paginatorMock);

    $result = $this->invoiceService->paginate();

    expect($result)->toBeInstanceOf(LengthAwarePaginator::class);
});

test('findById returns a invoice when found', function () {
    $this->repositoryMock->shouldReceive('findById')->with('1')->once()->andReturn($this->invoiceMock);

    $result = $this->invoiceService->findById('1');

    expect($result)->toBeInstanceOf(Invoice::class);
});

test('save creates and returns a new invoice', function () {
    $dataParamMock = Mockery::mock(InvoiceDataParam::class);
    $this->repositoryMock->shouldReceive('save')->with($dataParamMock)->once()->andReturn($this->invoiceMock);

    $result = $this->invoiceService->save($dataParamMock);

    expect($result)->toBeInstanceOf(Invoice::class);
});

test('update updates and returns the invoice', function () {
    $dataParamMock = Mockery::mock(InvoiceDataParam::class);
    $this->repositoryMock->shouldReceive('update')->with('1', $dataParamMock)->once()->andReturn($this->invoiceMock);
    $result = $this->invoiceService->update('1', $dataParamMock);

    expect($result)->toBeInstanceOf(Invoice::class);
});

test('delete deletes the invoice', function () {
    $this->repositoryMock->shouldReceive('delete')->with('1')->once();

    $this->invoiceService->delete('1');

    expect(true)->toBeTrue();
});
