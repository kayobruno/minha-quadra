<?php

declare(strict_types=1);

use App\Models\Merchant;
use App\Models\Product;
use App\Models\User;

beforeEach(function () {
    $this->merchant = Merchant::factory()->create();
    $this->user = User::factory()->create(['merchant_id' => $this->merchant->id]);
    $this->actingAs($this->user);
});

afterEach(function () {
    Product::truncate();
    User::truncate();
    Merchant::truncate();
});

test('the product update form screen can be rendered', function () {
    $product = Product::factory()->create();

    $response = $this->get('products/' . $product->id);

    $response->assertStatus(200);
    $response->assertViewIs('content.products.edit');
    $response->assertSee('Nome');
    $response->assertSee('Descrição');
    $response->assertSee('Preço');
    $response->assertSee('Tipo');
    $response->assertSee('EAN');
    $response->assertSee('Gerenciar Estoque?');
    $response->assertSee('Status');
    $response->assertSee('Salvar');
})->group('ProductController');

test('update a product', function () {
    $product = Product::factory()->create();

    $newAttributes = [
        'name' => 'New Product Name',
        'price' => '99,99',
    ];

    $this->put('products/' . $product->id . '/update', $newAttributes);

    $newAttributes['price'] = '99.99';

    $this->assertDatabaseHas('products', $newAttributes);
})->group('ProductController');

test('attempt to update a non-existing product', function () {
    $newAttributes = [
        'name' => 'New Product Name',
        'price' => '99,99',
    ];

    $response = $this->put('/products/999/update', $newAttributes);

    $response->assertStatus(404);
    $this->assertDatabaseMissing('products', $newAttributes);
})->group('ProductController');

test('update a product with required fields not provided', function () {
    $product = Product::factory()->create();
    $newAttributes = [
        'name' => '',
        'price' => '',
    ];

    $response = $this->put('/products/' . $product->id . '/update', $newAttributes);

    $response->assertSessionHasErrors(['name', 'price']);
    $this->assertDatabaseMissing('products', $newAttributes);
})->group('ProductController');

test('can not update a product with ean duplicated', function () {
    Product::factory()->create(['ean' => '123456789', 'merchant_id' => $this->merchant->id]);
    $product = Product::factory()->create(['merchant_id' => $this->merchant->id]);
    $newAttributes = [
        'name' => $product->name,
        'price' => (string) $product->price,
        'ean' => '123456789',
    ];

    $response = $this->put('/products/' . $product->id . '/update', $newAttributes);

    $response->assertSessionHasErrors(['ean']);
})->group('ProductController');
