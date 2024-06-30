<?php

declare(strict_types=1);

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
    $response->assertSee('Status');
    $response->assertSee('Salvar');
})->group('ProductController');

test('validates required fields when creating a new product', function () {
    $response = $this->post('/products/store', []);

    $response->assertSessionHasErrors(['name', 'price']);
})->group('ProductController');

test('can create a new product', function () {
    $response = $this->post('/products/store', [
        'name' => 'Produto de Teste',
        'price' => '10.99',
    ]);

    $response->assertStatus(302);
    $response->assertSee('Redirecting to');
    $this->assertDatabaseHas('products', ['name' => 'Produto de Teste']);
})->group('ProductController');
