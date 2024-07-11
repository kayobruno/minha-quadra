<?php

declare(strict_types=1);

use App\Enums\OrderStatus;
use App\Models\Activity;
use App\Models\Customer;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;

afterEach(function () {
    Activity::truncate();
    Customer::truncate();
    Merchant::truncate();
    OrderItem::truncate();
    Order::truncate();
    PaymentMethod::truncate();
});

it('can create an order', function () {
    $order = Order::factory()->create([
        'user_id' => 1,
        'merchant_id' => 1,
        'customer_id' => 1,
        'payment_method_id' => 1,
        'discount' => 10.0,
        'tab' => '#1',
        'status' => OrderStatus::Pending,
    ]);

    expect($order)->toBeInstanceOf(Order::class);
    expect($order->user_id)->toBe(1);
    expect($order->merchant_id)->toBe(1);
    expect($order->customer_id)->toBe(1);
    expect($order->payment_method_id)->toBe(1);
    expect($order->discount)->toBe(10.0);
    expect($order->tab)->toBe('#1');
    expect($order->status)->toBe(OrderStatus::Pending);
});

it('can access related items', function () {
    $order = Order::factory()->create();
    $items = OrderItem::factory()->count(3)->create([
        'order_id' => $order->id,
    ]);

    $relatedItems = $order->items;
    expect($relatedItems->count())->toBe(3);
    expect($relatedItems->first())->toBeInstanceOf(OrderItem::class);
});

it('can access related merchant, customer, and payment method', function () {
    $merchant = Merchant::factory()->create();
    $customer = Customer::factory()->create();
    $paymentMethod = PaymentMethod::factory()->create();

    $order = Order::factory()->create([
        'merchant_id' => $merchant->id,
        'customer_id' => $customer->id,
        'payment_method_id' => $paymentMethod->id,
    ]);

    expect($order->merchant)->toBeInstanceOf(Merchant::class);
    expect($order->customer)->toBeInstanceOf(Customer::class);
    expect($order->paymentMethod)->toBeInstanceOf(PaymentMethod::class);
});

it('can access related activities', function () {
    $order = Order::factory()->create();
    $activities = Activity::factory()->count(3)->create([
        'order_id' => $order->id,
    ]);

    $relatedActivities = $order->activities;
    expect($relatedActivities->count())->toBe(3);
    expect($relatedActivities->first())->toBeInstanceOf(Activity::class);
});

it('casts status to OrderStatus enum', function () {
    $order = Order::factory()->create([
        'status' => OrderStatus::Paid,
    ]);

    expect($order->status)->toBe(OrderStatus::Paid);
});

it('correctly identifies if order is paid', function () {
    $order = Order::factory()->create([
        'status' => OrderStatus::Paid,
    ]);

    expect($order->isPaid())->toBeTrue();

    $order = Order::factory()->create([
        'status' => OrderStatus::Pending,
    ]);

    expect($order->isPaid())->toBeFalse();
});

it('correctly calculates the subtotal', function () {
    $order = Order::factory()->create();
    $items = OrderItem::factory()->count(3)->create([
        'order_id' => $order->id,
        'product_price' => 50,
        'quantity' => 2,
    ]);

    expect($order->getSubtotal())->toBe(300.0);
});
