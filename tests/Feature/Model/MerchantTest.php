<?php

declare(strict_types=1);

use App\Enums\Status;
use App\Models\Merchant;
use App\Models\MerchantConfig;

afterEach(function () {
    Merchant::truncate();
});

it('can create a merchant', function () {
    $merchant = Merchant::factory()->create([
        'trade_name' => 'Example Trade Name',
        'document' => '123456789',
        'phone' => '123456789',
        'address' => '123 Example Street',
        'logo' => 'logo.png',
        'business_hours' => ['monday' => '9:00-18:00', 'tuesday' => '9:00-18:00'],
        'status' => Status::Active,
    ]);

    expect($merchant)->toBeInstanceOf(Merchant::class);
    expect($merchant->trade_name)->toBe('Example Trade Name');
    expect($merchant->document)->toBe('123456789');
    expect($merchant->phone)->toBe('123456789');
    expect($merchant->address)->toBe('123 Example Street');
    expect($merchant->logo)->toBe('logo.png');
    expect($merchant->business_hours)->toBe(['monday' => '9:00-18:00', 'tuesday' => '9:00-18:00']);
    expect($merchant->status)->toBe(Status::Active);
});

it('casts status to Status enum', function () {
    $merchant = Merchant::factory()->create([
        'status' => Status::Inactive,
    ]);

    expect($merchant->status)->toBe(Status::Inactive);
});

it('casts business_hours to array', function () {
    $merchant = Merchant::factory()->create([
        'business_hours' => ['monday' => '9:00-18:00', 'tuesday' => '9:00-18:00'],
    ]);

    expect($merchant->business_hours)->toBe(['monday' => '9:00-18:00', 'tuesday' => '9:00-18:00']);
});

it('can retrieve merchant configs', function () {
    $merchant = Merchant::factory()->create();

    $config1 = MerchantConfig::factory()->create([
        'merchant_id' => $merchant->id,
        'config_name' => 'Config 1',
        'config_value' => 'Value 1',
    ]);

    $config2 = MerchantConfig::factory()->create([
        'merchant_id' => $merchant->id,
        'config_name' => 'Config 2',
        'config_value' => 'Value 2',
    ]);

    $configs = $merchant->configs;

    expect($configs)->toHaveCount(2);
    expect($configs->pluck('id')->toArray())->toBe([$config1->id, $config2->id]);
});
