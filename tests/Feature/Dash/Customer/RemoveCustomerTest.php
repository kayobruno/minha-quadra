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

it('can remove a customer', function () {
    $customer = Customer::factory()->create();

    $this->delete('customers/' . $customer->id);

    $this->assertDatabaseMissing('customers', ['id' => $customer->id]);
})->group('CustomerController');

it('attempt to remove a non-existing customer', function () {
    Customer::factory()->count(50)->create();
    $response = $this->delete('/customers/999');

    $response->assertStatus(404);
    $this->assertDatabaseCount('customers', 50);
})->group('CustomerController');
