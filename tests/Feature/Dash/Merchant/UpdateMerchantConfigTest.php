<?php

declare(strict_types=1);

use App\Models\Merchant;
use App\Models\MerchantConfig;
use App\Models\User;

afterEach(function () {
    Merchant::truncate();
    MerchantConfig::truncate();
});

test('update my merchant configs', function () {
    $merchant = Merchant::factory()->create();
    $user = User::factory()->create(['merchant_id' => $merchant->id]);
    $this->actingAs($user);

    $configs = [
        'configs' => ['tag_total' => '10', 'min_hours_reserve' => '1'],
    ];

    $this->put('my-merchant/update-configs', $configs);

    $this->assertDatabaseHas('merchant_configs', ['config_name' => 'tag_total', 'config_value' => '10']);
})->group('MerchantController');
