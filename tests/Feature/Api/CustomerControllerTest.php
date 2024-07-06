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

test('it returns an empty list when no customers are registered', function () {
    $response = $this->get('/api/customers');
    $customers = json_decode($response->getContent(), true);

    expect($response->getStatusCode())->toBe(404);
    expect($customers['data'])->toBeNull();

    $response->assertJsonStructure([
        'data' => [],
    ]);
});

test('it returns a list of customers when filter is empty', function () {
    Customer::factory()->count(3)->create(['merchant_id' => $this->user->merchant_id]);

    $response = $this->get('/api/customers');
    $response->assertStatus(200);

    $response->assertJsonStructure([
        'data' => [
            '*' => ['id', 'name', 'phone'],
        ],
    ]);

    $response->assertJsonCount(3, 'data');
});

test('it returns no results when searching for a customer by name and no customer exists', function () {
    Customer::factory()->create(['merchant_id' => $this->user->merchant_id, 'name' => 'Kayo']);

    $response = $this->get('/api/customers?name=NonExistingCustomer');
    $customers = json_decode($response->getContent(), true);

    expect($response->getStatusCode())->toBe(404);
    expect($customers['data'])->toBeNull();
    $response->assertJsonStructure([
        'data' => [],
    ]);
});

test('it returns results when searching for a customer by name and customers exist', function () {
    Customer::factory()->create(['merchant_id' => $this->user->merchant_id, 'name' => 'Kayo']);

    $response = $this->get('/api/customers?name=Kayo');

    $response->assertStatus(200);
    $response->assertJsonCount(1, 'data');
    $response->assertJsonStructure([
        'data' => [
            '*' => ['id', 'name', 'phone'],
        ],
    ]);
});
