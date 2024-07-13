<?php

declare(strict_types=1);

use App\Contracts\DataParam;
use App\Models\Court;
use App\Repositories\CourtEloquentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

beforeEach(function () {
    $this->courtMock = Mockery::mock(Court::class);
    $this->courtRepository = new CourtEloquentRepository($this->courtMock);
});

afterEach(function () {
    Mockery::close();
});

test('getAll returns a collection of courts', function () {
    $this->courtMock->shouldReceive('all')->once()->andReturn(new Collection());

    $result = $this->courtRepository->getAll();

    expect($result)->toBeInstanceOf(Collection::class);
});

test('paginate returns a LengthAwarePaginator', function () {
    $paginatorMock = Mockery::mock(LengthAwarePaginator::class);
    $this->courtMock->shouldReceive('paginate')->once()->andReturn($paginatorMock);

    $result = $this->courtRepository->paginate();

    expect($result)->toBeInstanceOf(LengthAwarePaginator::class);
});

test('findById returns a court model when found', function () {
    $this->courtMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->courtMock->shouldReceive('first')->once()->andReturn($this->courtMock);

    $result = $this->courtRepository->findById('1');

    expect($result)->toBeInstanceOf(Court::class);
});

test('save creates and returns a new court', function () {
    $dataParamMock = Mockery::mock(DataParam::class);
    $dataParamMock->shouldReceive('toArray')->once()->andReturn(['foo' => 'bar']);
    $this->courtMock->shouldReceive('create')->with(['foo' => 'bar'])->once()->andReturn($this->courtMock);

    $result = $this->courtRepository->save($dataParamMock);

    expect($result)->toBeInstanceOf(Court::class);
});

test('update updates and returns the court', function () {
    $dataParamMock = Mockery::mock(DataParam::class);
    $dataParamMock->shouldReceive('toArray')->once()->andReturn(['foo' => 'bar']);
    $this->courtMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->courtMock->shouldReceive('first')->once()->andReturn($this->courtMock);
    $this->courtMock->shouldReceive('update')->with(['foo' => 'bar'])->once();

    $result = $this->courtRepository->update('1', $dataParamMock);

    expect($result)->toBeInstanceOf(Court::class);
});

test('delete deletes the court', function () {
    $this->courtMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->courtMock->shouldReceive('first')->once()->andReturn($this->courtMock);
    $this->courtMock->shouldReceive('delete')->once();

    $this->courtRepository->delete('1');

    expect(true)->toBeTrue();
});

test('builder returns a query builder', function () {
    $builderMock = Mockery::mock(Builder::class);
    $this->courtMock->shouldReceive('query')->once()->andReturn($builderMock);

    $result = $this->courtRepository->builder();

    expect($result)->toBeInstanceOf(Builder::class);
});
