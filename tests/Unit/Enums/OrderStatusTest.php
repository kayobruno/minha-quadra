<?php

declare(strict_types=1);

use App\Enums\OrderStatus;

it('returns all order statuses', function () {
    $expected = ['pending', 'paid', 'cancelled'];
    $actual = OrderStatus::all();

    $this->assertEquals($expected, $actual);
});

it('returns correct label for each order status', function () {
    $pendingLabel = OrderStatus::Pending->label();
    $paidLabel = OrderStatus::Paid->label();
    $cancelledLabel = OrderStatus::Cancelled->label();

    $this->assertEquals('Pendente', $pendingLabel);
    $this->assertEquals('Ativo', $paidLabel);
    $this->assertEquals('Inativo', $cancelledLabel);
});

it('returns correct tag for each order status', function () {
    $pendingTag = OrderStatus::Pending->tag();
    $paidTag = OrderStatus::Paid->tag();
    $cancelledTag = OrderStatus::Cancelled->tag();

    $this->assertEquals('<span class="badge bg-label-warning me-1">Pendente</span>', $pendingTag);
    $this->assertEquals('<span class="badge bg-label-primary me-1">Pago</span>', $paidTag);
    $this->assertEquals('<span class="badge bg-label-danger me-1">Cancelado</span>', $cancelledTag);
});
