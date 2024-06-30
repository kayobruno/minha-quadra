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

test('can remove a product', function () {
    $product = Product::factory()->create();

    $this->delete('products/' . $product->id);

    $this->assertDatabaseMissing('products', ['id' => $product->id]);
})->group('ProductController');

test('attempt to remove a non-existing product', function () {
    Product::factory()->count(50)->create();
    $response = $this->delete('/products/999');

    $response->assertStatus(404);
    $this->assertDatabaseCount('products', 50);
})->group('ProductController');
