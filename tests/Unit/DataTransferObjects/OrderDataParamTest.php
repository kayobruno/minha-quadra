<?php

declare(strict_types=1);

use App\DataTransferObjects\OrderDataParam;
use App\Enums\OrderStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

uses(TestCase::class);

beforeEach(function () {
    $this->user = User::factory()->make([
        'id' => 'user123',
        'merchant_id' => 'merchant456',
    ]);

    Auth::shouldReceive('user')->andReturn($this->user);
});

it('creates an OrderDataParam instance from request', function () {
    $request = Request::create('/order', 'POST', [
        'customer_id' => 'customer789',
        'payment_method_id' => 'payment321',
        'discount' => '5.0',
        'tab' => 'tab_value',
        'note' => 'sample_note',
    ]);

    $orderData = OrderDataParam::fromRequest($request);

    expect($orderData->customerId)->toBe('customer789');
    expect($orderData->status)->toBe(OrderStatus::Pending);
    expect($orderData->paymentMethodId)->toBe('payment321');
    expect($orderData->discount)->toBe('5.0');
    expect($orderData->tab)->toBe('tab_value');
    expect($orderData->note)->toBe('sample_note');
    expect($orderData->userId)->toBe('user123');
    expect($orderData->merchantId)->toBe('merchant456');
});
