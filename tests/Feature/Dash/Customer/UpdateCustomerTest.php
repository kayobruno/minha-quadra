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

it('the customer update form screen can be rendered', function () {
    $customer = Customer::factory()->create();

    $response = $this->get('customers/' . $customer->id);

    $response->assertStatus(200);
    $response->assertViewIs('content.customers.edit');
    $response->assertSee('Nome');
    $response->assertSee('Telefone');
    $response->assertSee('Salvar');
})->group('CustomerController');

it('can update a customer', function () {
    $customer = Customer::factory()->create();

    $newAttributes = [
        'name' => 'John Doe',
    ];

    $this->put('customers/' . $customer->id . '/update', $newAttributes);

    $this->assertDatabaseHas('customers', $newAttributes);
})->group('CustomerController');

it('attempt to update a non-existing customer', function () {
    $newAttributes = [
        'name' => 'John Doe',
    ];

    $response = $this->put('/customers/999/update', $newAttributes);

    $response->assertStatus(404);
    $this->assertDatabaseMissing('customers', $newAttributes);
})->group('CustomerController');

it('update a customer with required fields not provided', function () {
    $customer = Customer::factory()->create();
    $newAttributes = [];

    $response = $this->put('/customers/' . $customer->id . '/update', $newAttributes);

    $response->assertSessionHasErrors(['name']);
})->group('CustomerController');
