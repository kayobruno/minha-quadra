<?php

declare(strict_types=1);

use App\Enums\ProductType;
use App\Enums\Status;
use App\Models\Merchant;
use App\Models\Product;

afterEach(function () {
    Merchant::truncate();
    Product::truncate();
});

it('can create a product', function () {
    $product = Product::factory()->create([
        'merchant_id' => 1,
        'name' => 'Sample Product',
        'description' => 'This is a sample product.',
        'price' => 100.0,
        'type' => ProductType::Product,
        'stock' => 10,
        'status' => Status::Active,
    ]);

    expect($product)->toBeInstanceOf(Product::class);
    expect($product->merchant_id)->toBe(1);
    expect($product->name)->toBe('Sample Product');
    expect($product->description)->toBe('This is a sample product.');
    expect($product->price)->toBe(100.0);
    expect($product->type)->toBe(ProductType::Product);
    expect($product->stock)->toBe(10);
    expect($product->status)->toBe(Status::Active);
});

it('can access related merchant', function () {
    $merchant = Merchant::factory()->create();
    $product = Product::factory()->create([
        'merchant_id' => $merchant->id,
    ]);

    expect($product->merchant)->toBeInstanceOf(Merchant::class);
    expect($product->merchant->id)->toBe($merchant->id);
});

it('casts status and type to enums', function () {
    $product = Product::factory()->create([
        'status' => Status::Inactive,
        'type' => ProductType::Service,
    ]);

    expect($product->status)->toBe(Status::Inactive);
    expect($product->type)->toBe(ProductType::Service);
});
