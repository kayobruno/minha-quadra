<?php

declare(strict_types=1);

use App\Enums\ActivityType;

it('returns all activity types', function () {
    $expected = ['start-order', 'add-item', 'remove-item', 'update-item', 'partial-payment', 'finish-order'];
    $actual = ActivityType::all();

    $this->assertEquals($expected, $actual);
});

it('returns correct label for each activity type', function () {
    $startOrderLabel = ActivityType::StartOrder->label();
    $addItemLabel = ActivityType::AddItem->label();
    $removeItemLabel = ActivityType::RemoveItem->label();
    $updateItemLabel = ActivityType::UpdateItem->label();
    $partialPaymentLabel = ActivityType::PartialPayment->label();
    $finishOrderLabel = ActivityType::FinishOrder->label();

    $this->assertEquals('Pedido Iniciado', $startOrderLabel);
    $this->assertEquals('Item Adicionado', $addItemLabel);
    $this->assertEquals('Item Removido', $removeItemLabel);
    $this->assertEquals('Item Atualizado', $updateItemLabel);
    $this->assertEquals('Pagamento Parcial Realizado', $partialPaymentLabel);
    $this->assertEquals('Pedido Finalizado', $finishOrderLabel);
});

it('returns correct color for each activity type', function () {
    $startOrderColor = ActivityType::StartOrder->color();
    $addItemColor = ActivityType::AddItem->color();
    $removeItemColor = ActivityType::RemoveItem->color();
    $updateItemColor = ActivityType::UpdateItem->color();
    $partialPaymentColor = ActivityType::PartialPayment->color();
    $finishOrderColor = ActivityType::FinishOrder->color();

    $this->assertEquals('secondary', $startOrderColor);
    $this->assertEquals('primary', $addItemColor);
    $this->assertEquals('danger', $removeItemColor);
    $this->assertEquals('warning', $updateItemColor);
    $this->assertEquals('info', $partialPaymentColor);
    $this->assertEquals('success', $finishOrderColor);
});
