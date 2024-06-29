<?php

declare(strict_types=1);

use App\Enums\ProductType;
use App\Enums\Status;
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

test('the product registration form screen can be rendered', function () {
    $response = $this->get('/products/create');

    $response->assertStatus(200);
    $response->assertViewIs('content.products.create');
    $response->assertSee('Nome');
    $response->assertSee('Descrição');
    $response->assertSee('Preço');
    $response->assertSee('Tipo');
    $response->assertSee('EAN');
    $response->assertSee('Gerenciar Estoque?');
    $response->assertSee('Status');
    $response->assertSee('Salvar');
})->group('ProductController');

test('validates required fields when creating a new product', function () {
    $response = $this->post('/products/store', []);

    $response->assertSessionHasErrors(['name', 'price']);
})->group('ProductController');

test('can create a new product', function () {
    $productData = [
        'name' => 'Produto de Teste',
        'description' => 'fake desc',
        'price' => '10,99',
    ];

    $response = $this->post('/products/store', $productData);

    $expectedData = [
        ...$productData,
        'price' => '10.99',
        'type' => ProductType::Product->value,
        'status' => Status::Pending->value,
        'manage_stock' => false,
    ];

    $response->assertStatus(302);
    $response->assertSee('Redirecting to');
    $this->assertDatabaseHas('products', $expectedData);
})->group('ProductController');
