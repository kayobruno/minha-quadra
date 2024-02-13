<?php

declare(strict_types=1);

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

afterEach(function () {
    DB::table('products')->truncate();
    DB::table('users')->truncate();
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
    $response->assertSee('Status');
    $response->assertSee('Salvar');
})->group('ProductController');

test('update a product', function () {
    $product = Product::factory()->create();

    $newAttributes = [
        'name' => 'New Product Name',
        'price' => 99.99,
        'description' => 'New Description',
    ];

    $this->put('products/' . $product->id . '/update', $newAttributes);

    $this->assertDatabaseHas('products', $newAttributes);
})->group('ProductController');

test('attempt to update a non-existing product', function () {
    $newAttributes = [
        'name' => 'New Product Name',
        'price' => 99.99,
        'description' => 'New Description',
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
        'description' => 'New Description',
    ];

    $response = $this->put('/products/' . $product->id . '/update', $newAttributes);

    $response->assertSessionHasErrors(['name', 'price']);
    $this->assertDatabaseMissing('products', $newAttributes);
})->group('ProductController');
