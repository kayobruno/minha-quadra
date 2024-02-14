<?php

declare(strict_types=1);

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\DB;

afterEach(function () {
    DB::table('suppliers')->truncate();
    DB::table('users')->truncate();
});

test('it can list suppliers', function () {
    Supplier::factory()->count(10)->create();

    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/suppliers');

    $response->assertStatus(200);
    $response->assertViewIs('content.suppliers.index');
    $response->assertSee('Cadastrar');
    $response->assertSee('Nome');
    $response->assertSee('Documento');
    $response->assertSee('Tipo');
    $response->assertSee('Status');
})->group('SupplierController');

test('suppliers screen can be rendered with empty list of suppliers', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/suppliers');

    $response->assertStatus(200);
    $response->assertViewIs('content.suppliers.index');
    $response->assertSee('Cadastrar');
    $response->assertSee('Nenhum Fornecedor cadastrado!');
})->group('SupplierController');

test('it can list suppliers with pagination', function () {
    Supplier::factory()->count(50)->create();

    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/suppliers');

    $response->assertStatus(200);
    $response->assertViewIs('content.suppliers.index');
    $response->assertSee('Cadastrar');
    $response->assertSee('page-item active');
})->group('SupplierController');

test('redirect to login when user tries to list suppliers without being logged in', function () {
    $response = $this->get('/suppliers');

    $response->assertStatus(302);
    $response->assertSee('Redirecting to');
})->group('SupplierController');
