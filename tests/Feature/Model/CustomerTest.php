<?php

declare(strict_types=1);

use App\Models\Customer;
use App\Models\Merchant;
use App\Models\Order;

afterEach(function () {
    Customer::truncate();
    Merchant::truncate();
    Order::truncate();
});

it('can create a customer', function () {
    $merchant = Merchant::factory()->create();
    $customer = Customer::factory()->create([
        'name' => 'John Doe',
        'phone' => '1234567890',
        'merchant_id' => $merchant->id,
    ]);

    expect($customer)->toBeInstanceOf(Customer::class);
    expect($customer->name)->toBe('John Doe');
    expect($customer->phone)->toBe('1234567890');
    expect($customer->merchant_id)->toBe($merchant->id);
});

it('can access related merchant', function () {
    $merchant = Merchant::factory()->create();
    $customer = Customer::factory()->create([
        'name' => 'John Doe',
        'phone' => '1234567890',
        'merchant_id' => $merchant->id,
    ]);

    $relatedMerchant = $customer->merchant;
    expect($relatedMerchant)->toBeInstanceOf(Merchant::class);
    expect($relatedMerchant->id)->toBe($merchant->id);
});

it('can access related orders', function () {
    $customer = Customer::factory()->create();
    $orders = Order::factory()->count(3)->create([
        'customer_id' => $customer->id,
    ]);

    $relatedOrders = $customer->orders;
    expect($relatedOrders->count())->toBe(3);
    expect($relatedOrders->first())->toBeInstanceOf(Order::class);
});

it('calculates initials correctly', function () {
    $customer = Customer::factory()->create([
        'name' => 'John Doe',
    ]);

    $initials = $customer->getInitials();
    expect($initials)->toBe('JD');
});

it('calculates total orders correctly', function () {
    $customer = Customer::factory()->create();

    Order::factory()->count(3)->create([
        'customer_id' => $customer->id,
    ]);

    $totalOrders = $customer->getTotalOrders();
    expect($totalOrders)->toBe(3);
});
