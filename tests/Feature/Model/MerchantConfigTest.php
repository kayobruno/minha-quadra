<?php

declare(strict_types=1);

use App\Models\MerchantConfig;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('has a merchant relationship', function () {
    $merchantConfig = new MerchantConfig();
    $relationship = $merchantConfig->merchant();

    expect($relationship)->toBeInstanceOf(BelongsTo::class);
    expect($relationship->getForeignKeyName())->toBe('id');
});

it('has fillable attributes', function () {
    $merchantConfig = new MerchantConfig();

    expect($merchantConfig->getFillable())->toBe([
        'merchant_id',
        'config_name',
        'config_value',
    ]);
});
