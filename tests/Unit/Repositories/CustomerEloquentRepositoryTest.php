<?php

declare(strict_types=1);

use App\Contracts\DataParam;
use App\Models\Customer;
use App\Repositories\CustomerEloquentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

beforeEach(function () {
    $this->customerMock = Mockery::mock(Customer::class);
    $this->customerRepository = new CustomerEloquentRepository($this->customerMock);
});

afterEach(function () {
    Mockery::close();
});

test('getAll returns a collection of customers', function () {
    $this->customerMock->shouldReceive('all')->once()->andReturn(new Collection());

    $result = $this->customerRepository->getAll();

    expect($result)->toBeInstanceOf(Collection::class);
});

test('paginate returns a LengthAwarePaginator', function () {
    $paginatorMock = Mockery::mock(LengthAwarePaginator::class);
    $this->customerMock->shouldReceive('paginate')->once()->andReturn($paginatorMock);

    $result = $this->customerRepository->paginate();

    expect($result)->toBeInstanceOf(LengthAwarePaginator::class);
});

test('findById returns a customer when found', function () {
    $this->customerMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->customerMock->shouldReceive('first')->once()->andReturn($this->customerMock);

    $result = $this->customerRepository->findById('1');

    expect($result)->toBeInstanceOf(Customer::class);
});

test('save creates and returns a new customer', function () {
    $dataParamMock = Mockery::mock(DataParam::class);
    $dataParamMock->shouldReceive('toArray')->once()->andReturn(['foo' => 'bar']);
    $this->customerMock->shouldReceive('create')->with(['foo' => 'bar'])->once()->andReturn($this->customerMock);

    $result = $this->customerRepository->save($dataParamMock);

    expect($result)->toBeInstanceOf(Customer::class);
});

test('update updates and returns the customer', function () {
    $dataParamMock = Mockery::mock(DataParam::class);
    $dataParamMock->shouldReceive('toArray')->once()->andReturn(['foo' => 'bar']);
    $this->customerMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->customerMock->shouldReceive('first')->once()->andReturn($this->customerMock);
    $this->customerMock->shouldReceive('update')->with(['foo' => 'bar'])->once();

    $result = $this->customerRepository->update('1', $dataParamMock);

    expect($result)->toBeInstanceOf(Customer::class);
});

test('delete deletes the customer', function () {
    $this->customerMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->customerMock->shouldReceive('first')->once()->andReturn($this->customerMock);
    $this->customerMock->shouldReceive('delete')->once();

    $this->customerRepository->delete('1');

    expect(true)->toBeTrue();
});

test('builder returns a query builder', function () {
    $builderMock = Mockery::mock(Builder::class);
    $this->customerMock->shouldReceive('query')->once()->andReturn($builderMock);

    $result = $this->customerRepository->builder();

    expect($result)->toBeInstanceOf(Builder::class);
});
