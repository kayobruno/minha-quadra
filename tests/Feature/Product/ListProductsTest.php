<?php

declare(strict_types=1);

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

afterEach(function () {
    DB::table('products')->truncate();
    DB::table('users')->truncate();
});

test('it can list products', function () {
    Product::factory()->count(10)->create();

    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/products');

    $response->assertStatus(200);
    $response->assertViewIs('content.products.index');
    $response->assertSee('Cadastrar');
    $response->assertSee('Nome');
    $response->assertSee('Preço');
    $response->assertSee('Estoque');
    $response->assertSee('Status');
})->group('ProductController');

test('products screen can be rendered with empty list of products', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/products');

    $response->assertStatus(200);
    $response->assertViewIs('content.products.index');
    $response->assertSee('Cadastrar');
    $response->assertSee('Nenhum Produto cadastrado!');
})->group('ProductController');


test('it can list products with pagination', function () {
    Product::factory()->count(50)->create();

    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/products');

    $response->assertStatus(200);
    $response->assertViewIs('content.products.index');
    $response->assertSee('Cadastrar');
    $response->assertSee('page-item active');
})->group('ProductController');

test('redirect to login when user tries to list products without being logged in', function () {
    $response = $this->get('/products');

    $response->assertStatus(302);
    $response->assertSee('Redirecting to');
})->group('ProductController');
