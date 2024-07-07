<?php

declare(strict_types=1);

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

afterEach(function () {
    DB::table('orders')->truncate();
    DB::table('users')->truncate();
});

test('it can list orders', function () {
    $order = Order::factory()->create();
    $items = OrderItem::factory()->count(3)->create([
        'order_id' => $order->id,
    ]);

    $response = $this->get('/orders');

    $response->assertStatus(200);
    $response->assertViewIs('content.orders.index');
    $response->assertSee('Cadastrar');
    $response->assertSee('Cliente');
    $response->assertSee('Comanda');
    $response->assertSee('Total');
    $response->assertSee('Data de Cadastro');
    $response->assertSee('Status');
})->group('OrderController');

test('it can list orders with pagination', function () {
    Order::factory()->count(50)
        ->hasItems(3, function (array $attributes, Order $order) {
            return ['order_id' => $order->id];
        })
        ->create();

    $response = $this->get('/orders');

    $response->assertStatus(200);
    $response->assertViewIs('content.orders.index');
    $response->assertSee('Cadastrar');
    $response->assertSee('page-item active');
})->group('OrderController');

test('orders screen can be rendered with empty list of orders', function () {
    $response = $this->get('/orders');

    $response->assertStatus(200);
    $response->assertViewIs('content.orders.index');
    $response->assertSee('Cadastrar');
    $response->assertSee('Nenhum Pedido cadastrado!');
})->group('OrderController');
