<?php

declare(strict_types=1);

use App\Models\Customer;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

afterEach(function () {
    Order::truncate();
    User::truncate();
    Merchant::truncate();
    Customer::truncate();
});

it('can to init order', function () {
    $customer = Customer::factory()->create();
    $response = $this->post('/api/orders/init', ['customer_id' => $customer->id, 'tab' => '1']);

    expect($response->getStatusCode())->toBe(201);
});
