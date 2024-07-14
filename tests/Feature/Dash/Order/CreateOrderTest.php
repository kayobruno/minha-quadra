<?php

declare(strict_types=1);

use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

afterEach(function () {
    User::truncate();
});

test('the order registration form screen can be rendered', function () {
    $response = $this->get('/orders/create');

    $response->assertStatus(200);
    $response->assertViewIs('content.orders.create');
    $response->assertSee('Pedido');
    $response->assertSee('Comanda');
    $response->assertSee('Data');
})->group('OrderController');
