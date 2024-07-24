<?php

declare(strict_types=1);

use App\DataTransferObjects\InvoiceDataParam;
use App\Models\Invoice;
use App\Repositories\InvoiceEloquentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

beforeEach(function () {
    $this->invoiceMock = Mockery::mock(Invoice::class);
    $this->invoiceRepository = new InvoiceEloquentRepository($this->invoiceMock);
});

afterEach(function () {
    Mockery::close();
});

test('getAll returns a collection', function () {
    $this->invoiceMock->shouldReceive('all')->once()->andReturn(new Collection());

    $result = $this->invoiceRepository->getAll();

    expect($result)->toBeInstanceOf(Collection::class);
});

test('paginate returns a LengthAwarePaginator', function () {
    $paginatorMock = Mockery::mock(LengthAwarePaginator::class);
    $this->invoiceMock->shouldReceive('paginate')->once()->andReturn($paginatorMock);

    $result = $this->invoiceRepository->paginate();

    expect($result)->toBeInstanceOf(LengthAwarePaginator::class);
});

test('findById returns a invoice when found', function () {
    $this->invoiceMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->invoiceMock->shouldReceive('first')->once()->andReturn($this->invoiceMock);

    $result = $this->invoiceRepository->findById('1');

    expect($result)->toBeInstanceOf(Invoice::class);
});

test('save creates and returns a new invoice', function () {
    $dataParamMock = Mockery::mock(InvoiceDataParam::class);
    $dataParamMock->shouldReceive('toArray')->once()->andReturn(['foo' => 'bar']);
    $this->invoiceMock->shouldReceive('create')->with(['foo' => 'bar'])->once()->andReturn($this->invoiceMock);

    $result = $this->invoiceRepository->save($dataParamMock);

    expect($result)->toBeInstanceOf(Invoice::class);
});

test('update updates and returns the invoice', function () {
    $dataParamMock = Mockery::mock(InvoiceDataParam::class);
    $dataParamMock->shouldReceive('toArray')->once()->andReturn(['foo' => 'bar']);
    $this->invoiceMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->invoiceMock->shouldReceive('first')->once()->andReturn($this->invoiceMock);
    $this->invoiceMock->shouldReceive('update')->with(['foo' => 'bar'])->once();

    $result = $this->invoiceRepository->update('1', $dataParamMock);

    expect($result)->toBeInstanceOf(Invoice::class);
});

test('delete deletes the invoice', function () {
    $this->invoiceMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->invoiceMock->shouldReceive('first')->once()->andReturn($this->invoiceMock);
    $this->invoiceMock->shouldReceive('delete')->once();

    $this->invoiceRepository->delete('1');

    expect(true)->toBeTrue();
});
