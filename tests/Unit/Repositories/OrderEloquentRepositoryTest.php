<?php

declare(strict_types=1);

use App\Contracts\DataParam;
use App\Models\Order;
use App\Repositories\OrderEloquentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

beforeEach(function () {
    $this->orderMock = Mockery::mock(Order::class);
    $this->orderRepository = new OrderEloquentRepository($this->orderMock);
});

afterEach(function () {
    Mockery::close();
});

test('getAll returns a collection of orders', function () {
    $this->orderMock->shouldReceive('all')->once()->andReturn(new Collection());

    $result = $this->orderRepository->getAll();

    expect($result)->toBeInstanceOf(Collection::class);
});

test('paginate returns a LengthAwarePaginator', function () {
    $paginatorMock = Mockery::mock(LengthAwarePaginator::class);
    $this->orderMock->shouldReceive('paginate')->once()->andReturn($paginatorMock);

    $result = $this->orderRepository->paginate();

    expect($result)->toBeInstanceOf(LengthAwarePaginator::class);
});

test('findById returns a model when found', function () {
    $this->orderMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->orderMock->shouldReceive('first')->once()->andReturn($this->orderMock);

    $result = $this->orderRepository->findById('1');

    expect($result)->toBeInstanceOf(Order::class);
});

test('save creates and returns a new order', function () {
    $dataParamMock = Mockery::mock(DataParam::class);
    $dataParamMock->shouldReceive('toArray')->once()->andReturn(['foo' => 'bar']);
    $this->orderMock->shouldReceive('create')->with(['foo' => 'bar'])->once()->andReturn($this->orderMock);

    $result = $this->orderRepository->save($dataParamMock);

    expect($result)->toBeInstanceOf(Order::class);
});

test('update updates and returns the order', function () {
    $dataParamMock = Mockery::mock(DataParam::class);
    $dataParamMock->shouldReceive('toArray')->once()->andReturn(['foo' => 'bar']);
    $this->orderMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->orderMock->shouldReceive('first')->once()->andReturn($this->orderMock);
    $this->orderMock->shouldReceive('update')->with(['foo' => 'bar'])->once();

    $result = $this->orderRepository->update('1', $dataParamMock);

    expect($result)->toBeInstanceOf(Order::class);
});

test('delete deletes the order', function () {
    $this->orderMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->orderMock->shouldReceive('first')->once()->andReturn($this->orderMock);
    $this->orderMock->shouldReceive('delete')->once();

    $this->orderRepository->delete('1');

    expect(true)->toBeTrue();
});

test('builder returns a query builder', function () {
    $builderMock = Mockery::mock(Builder::class);
    $this->orderMock->shouldReceive('query')->once()->andReturn($builderMock);

    $result = $this->orderRepository->builder();

    expect($result)->toBeInstanceOf(Builder::class);
});
