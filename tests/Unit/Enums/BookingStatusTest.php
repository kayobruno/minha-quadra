<?php

declare(strict_types=1);

use App\Enums\BookingStatus;

it('returns all booking statuses', function () {
    $expected = ['confirm', 'canceled', 'finished', 'progress'];
    $actual = BookingStatus::all();

    $this->assertEquals($expected, $actual);
});

it('returns correct label for each booking status', function () {
    $confirmLabel = BookingStatus::Confirm->label();
    $canceledLabel = BookingStatus::Canceled->label();
    $finishedLabel = BookingStatus::Finished->label();
    $progressLabel = BookingStatus::Progress->label();

    $this->assertEquals('Confirmado', $confirmLabel);
    $this->assertEquals('Cancelado', $canceledLabel);
    $this->assertEquals('Finalizado', $finishedLabel);
    $this->assertEquals('Em Andamento', $progressLabel);
});

it('returns correct tag for each booking status', function () {
    $confirmTag = BookingStatus::Confirm->tag();
    $canceledTag = BookingStatus::Canceled->tag();
    $finishedTag = BookingStatus::Finished->tag();
    $progressTag = BookingStatus::Progress->tag();

    $this->assertEquals('<span class="badge bg-label-success me-1">Confirmado</span>', $confirmTag);
    $this->assertEquals('<span class="badge bg-label-danger me-1">Cancelado</span>', $canceledTag);
    $this->assertEquals('<span class="badge bg-label-primary me-1">Finalizado</span>', $finishedTag);
    $this->assertEquals('<span class="badge bg-label-info me-1">Em Andamento</span>', $progressTag);
});

it('checks if booking status is editable', function () {
    $progressEditable = BookingStatus::Progress->isEditable();
    $confirmEditable = BookingStatus::Confirm->isEditable();
    $canceledEditable = BookingStatus::Canceled->isEditable();
    $finishedEditable = BookingStatus::Finished->isEditable();

    $this->assertTrue($progressEditable);
    $this->assertTrue($confirmEditable);
    $this->assertFalse($canceledEditable);
    $this->assertFalse($finishedEditable);
});
