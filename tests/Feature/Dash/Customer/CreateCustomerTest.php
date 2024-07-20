<?php

declare(strict_types=1);

use App\Models\Customer;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

afterEach(function () {
    Customer::truncate();
    User::truncate();
});

it('the customers registration form screen can be rendered', function () {
    $response = $this->get('/customers/create');

    $response->assertStatus(200);
    $response->assertViewIs('content.customers.create');
    $response->assertSee('Nome');
    $response->assertSee('Telefone');
    $response->assertSee('Salvar');
})->group('CustomerController');

it('validates required fields when creating a new customer', function () {
    $response = $this->post('/customers/store', []);

    $response->assertSessionHasErrors(['name']);
})->group('CustomerController');

it('can create a new customers with just name', function () {
    $response = $this->post('/customers/store', [
        'name' => 'John Doe',
    ]);

    $response->assertStatus(302);
    $response->assertSee('Redirecting to');
    $this->assertDatabaseHas('customers', ['name' => 'John Doe']);
})->group('CustomerController');

it('can create a new customers with name and phone', function () {
    $response = $this->post('/customers/store', [
        'name' => 'John Doe',
        'phone' => '99 9999-9999',
    ]);

    $response->assertStatus(302);
    $response->assertSee('Redirecting to');
    $this->assertDatabaseHas('customers', ['name' => 'John Doe', 'phone' => '99 9999-9999']);
})->group('CustomerController');
