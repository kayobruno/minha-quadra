<?php

declare(strict_types=1);

use App\Models\Court;
use App\Models\Merchant;

afterEach(function () {
    Court::truncate();
    Merchant::truncate();
});

it('can create a court', function () {
    $merchant = Merchant::factory()->create();

    $court = Court::factory()->create([
        'name' => 'Main Court',
        'color' => '#FF5733',
        'merchant_id' => $merchant->id,
    ]);

    expect($court)->toBeInstanceOf(Court::class);
    expect($court->name)->toBe('Main Court');
    expect($court->color)->toBe('#FF5733');
    expect($court->merchant_id)->toBe($merchant->id);
});

it('can access related merchant', function () {
    $merchant = Merchant::factory()->create();

    $court = Court::factory()->create([
        'name' => 'Main Court',
        'color' => '#FF5733',
        'merchant_id' => $merchant->id,
    ]);

    $relatedMerchant = $court->merchant;
    expect($relatedMerchant)->toBeInstanceOf(Merchant::class);
    expect($relatedMerchant->id)->toBe($merchant->id);
});

it('converts color to rgba', function () {
    $merchant = Merchant::factory()->create();

    $court = Court::factory()->create([
        'name' => 'Main Court',
        'color' => '#FF5733',
        'merchant_id' => $merchant->id,
    ]);

    $rgbaColor = $court->color_rgba;
    expect($rgbaColor)->toBe('rgba(255,87,51,0.5)');
});
