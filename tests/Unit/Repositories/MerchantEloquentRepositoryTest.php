<?php

declare(strict_types=1);

use App\Contracts\DataParam;
use App\Models\Merchant;
use App\Repositories\MerchantEloquentRepository;

beforeEach(function () {
    $this->merchantMock = Mockery::mock(Merchant::class);
    $this->merchantRepository = new MerchantEloquentRepository($this->merchantMock);
});

afterEach(function () {
    Mockery::close();
});

test('save creates and returns a new Merchant', function () {
    $dataParamMock = Mockery::mock(DataParam::class);
    $dataParamMock->shouldReceive('toArray')->once()->andReturn(['foo' => 'bar']);
    $this->merchantMock->shouldReceive('create')->with(['foo' => 'bar'])->once()->andReturn($this->merchantMock);

    $result = $this->merchantRepository->save($dataParamMock);

    expect($result)->toBeInstanceOf(Merchant::class);
});

test('update updates and returns the Merchant', function () {
    $dataParamMock = Mockery::mock(DataParam::class);
    $dataParamMock->shouldReceive('toArray')->once()->andReturn(['foo' => 'bar']);

    $this->merchantMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->merchantMock->shouldReceive('first')->once()->andReturn($this->merchantMock);
    $this->merchantMock->shouldReceive('update')->with(['foo' => 'bar'])->once();

    $result = $this->merchantRepository->update('1', $dataParamMock);

    expect($result)->toBeInstanceOf(Merchant::class);
});

test('delete deletes the Merchant', function () {
    $this->merchantMock->shouldReceive('whereId')->with('1')->once()->andReturnSelf();
    $this->merchantMock->shouldReceive('first')->once()->andReturn($this->merchantMock);
    $this->merchantMock->shouldReceive('delete')->once();

    $this->merchantRepository->delete('1');

    expect(true)->toBeTrue();
});
