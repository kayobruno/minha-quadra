<?php

declare(strict_types=1);

use App\Contracts\MerchantRepository;
use App\DataTransferObjects\MerchantData;
use App\Services\MerchantService;
use Illuminate\Database\Eloquent\Model;

beforeEach(function () {
    $this->merchantRepository = Mockery::mock(MerchantRepository::class);
    $this->merchantService = new MerchantService($this->merchantRepository);
});

afterEach(function () {
    Mockery::close();
});

it('saves merchant data correctly', function () {
    $merchantData = Mockery::mock(MerchantData::class);
    $expectedModel = Mockery::mock(Model::class);

    $this->merchantRepository
        ->shouldReceive('save')
        ->once()
        ->with($merchantData)
        ->andReturn($expectedModel);

    $result = $this->merchantService->save($merchantData);

    expect($result)->toBe($expectedModel);
});

it('updates merchant data correctly', function () {
    $id = '123';
    $merchantData = Mockery::mock(MerchantData::class);
    $expectedModel = Mockery::mock(Model::class);

    $this->merchantRepository
        ->shouldReceive('update')
        ->once()
        ->with($id, $merchantData)
        ->andReturn($expectedModel);

    $result = $this->merchantService->update($id, $merchantData);

    expect($result)->toBe($expectedModel);
});

it('deletes merchant data correctly', function () {
    $id = '123';

    $this->merchantRepository
        ->shouldReceive('delete')
        ->once()
        ->with($id);

    $this->merchantService->delete($id);

    expect(true)->toBeTrue();
});
