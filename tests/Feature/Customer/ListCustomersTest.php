<?php

declare(strict_types=1);

use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\DB;

afterEach(function () {
    DB::table('customers')->truncate();
    DB::table('users')->truncate();
});

test('it can list customers', function () {
    Customer::factory()->count(10)->create();

    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/customers');

    $response->assertStatus(200);
    $response->assertViewIs('content.customers.index');
    $response->assertSee('Cadastrar');
    $response->assertSee('Nome');
    $response->assertSee('Telefone');
    $response->assertSee('Data de Cadastro');
})->group('CustomerController');

test('it can list customers with pagination', function () {
    Customer::factory()->count(50)->create();

    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/customers');

    $response->assertStatus(200);
    $response->assertViewIs('content.customers.index');
    $response->assertSee('Cadastrar');
    $response->assertSee('page-item active');
})->group('CustomerController');

test('redirect to login when user tries to list customers without being logged in', function () {
    $response = $this->get('/customers');

    $response->assertStatus(302);
    $response->assertSee('Redirecting to');
})->group('CustomerController');

test('customers screen can be rendered with empty list of customers', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/customers');

    $response->assertStatus(200);
    $response->assertViewIs('content.customers.index');
    $response->assertSee('Cadastrar');
    $response->assertSee('Nenhum Cliente cadastrado!');
})->group('CustomerController');
