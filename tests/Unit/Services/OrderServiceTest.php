<?php

declare(strict_types=1);

use App\Contracts\OrderRepository;
use App\Models\Merchant;
use App\Services\OrderService;
use Faker\Factory as Faker;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Mockery;

it('returns paginated orders', function () {
    $orderRepositoryMock = Mockery::mock(OrderRepository::class);
    $paginatorMock = Mockery::mock(LengthAwarePaginator::class);
    $orderRepositoryMock->shouldReceive('paginate')
        ->once()
        ->andReturn($paginatorMock);

    $service = new OrderService($orderRepositoryMock);

    expect($service->paginate())->toBe($paginatorMock);
});

it('returns available tabs for a merchant', function () {
    $faker = Faker::create();
    $orderRepositoryMock = Mockery::mock(OrderRepository::class);
    $merchantMock = Mockery::mock(Merchant::class);

    $merchantMock->shouldReceive('getAttribute')
        ->with('id')
        ->andReturn($faker->randomNumber());

    $merchantMock->shouldReceive('getTabsTotal')
        ->twice()
        ->andReturn(10);

    $orderRepositoryMock->shouldReceive('getUnavailableTabs')
        ->with($merchantMock->id)
        ->once()
        ->andReturn([2, 4, 7]);

    $service = new OrderService($orderRepositoryMock);

    $expectedAvailableTabs = array_diff(range(1, 10), [2, 4, 7]);

    expect(array_values($service->getAvailableTabsByMerchant($merchantMock)))->toBe(array_values($expectedAvailableTabs));
});

it('uses default max tabs if merchant has no tabs total defined', function () {
    $faker = Faker::create();
    $orderRepositoryMock = Mockery::mock(OrderRepository::class);
    $merchantMock = Mockery::mock(Merchant::class);

    $merchantMock->shouldReceive('getAttribute')
        ->with('id')
        ->andReturn($faker->randomNumber());

    $merchantMock->shouldReceive('getTabsTotal')
        ->once()
        ->andReturn(0);

    $orderRepositoryMock->shouldReceive('getUnavailableTabs')
        ->with($merchantMock->id)
        ->once()
        ->andReturn([2, 4, 7]);

    $service = new OrderService($orderRepositoryMock);
    $expectedAvailableTabs = array_diff(range(1, 10), [2, 4, 7]);

    expect(array_values($service->getAvailableTabsByMerchant($merchantMock)))->toBe(array_values($expectedAvailableTabs));
});
