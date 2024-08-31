<?php

declare(strict_types=1);

use App\Contracts\DataParam;
use App\Models\Booking;
use App\Repositories\BookingEloquentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

beforeEach(function () {
    $this->bookingMock = Mockery::mock(Booking::class);
    $this->bookingRepository = new BookingEloquentRepository($this->bookingMock);
});

afterEach(function () {
    Mockery::close();
});

test('getAll returns a collection of bookings', function () {
    $this->bookingMock->shouldReceive('all')->once()->andReturn(new Collection());

    $result = $this->bookingRepository->getAll();

    expect($result)->toBeInstanceOf(Collection::class);
});

test('paginate returns a LengthAwarePaginator', function () {
    $paginatorMock = Mockery::mock(LengthAwarePaginator::class);
    $this->bookingMock->shouldReceive('paginate')->once()->andReturn($paginatorMock);

    $result = $this->bookingRepository->paginate();

    expect($result)->toBeInstanceOf(LengthAwarePaginator::class);
});

test('findById returns a booking when found', function () {
    $this->bookingMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->bookingMock->shouldReceive('first')->once()->andReturn($this->bookingMock);

    $result = $this->bookingRepository->findById('1');

    expect($result)->toBeInstanceOf(booking::class);
});

test('save creates and returns a new booking', function () {
    $dataParamMock = Mockery::mock(DataParam::class);
    $dataParamMock->shouldReceive('toArray')->once()->andReturn(['foo' => 'bar']);
    $this->bookingMock->shouldReceive('create')->with(['foo' => 'bar'])->once()->andReturn($this->bookingMock);

    $result = $this->bookingRepository->save($dataParamMock);

    expect($result)->toBeInstanceOf(booking::class);
});

test('update updates and returns the booking', function () {
    $dataParamMock = Mockery::mock(DataParam::class);
    $dataParamMock->shouldReceive('toArray')->once()->andReturn(['foo' => 'bar']);
    $this->bookingMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->bookingMock->shouldReceive('first')->once()->andReturn($this->bookingMock);
    $this->bookingMock->shouldReceive('update')->with(['foo' => 'bar'])->once();

    $result = $this->bookingRepository->update('1', $dataParamMock);

    expect($result)->toBeInstanceOf(booking::class);
});

test('delete deletes the booking', function () {
    $this->bookingMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->bookingMock->shouldReceive('first')->once()->andReturn($this->bookingMock);
    $this->bookingMock->shouldReceive('delete')->once();

    $this->bookingRepository->delete('1');

    expect(true)->toBeTrue();
});
