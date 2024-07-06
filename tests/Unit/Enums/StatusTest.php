<?php

declare(strict_types=1);

use App\Enums\Status;

it('returns all statuses', function () {
    $expected = ['pending', 'active', 'inactive'];
    $actual = Status::all();

    $this->assertEquals($expected, $actual);
});

it('returns correct label for each status', function () {
    $pendingLabel = Status::Pending->label();
    $activeLabel = Status::Active->label();
    $inactiveLabel = Status::Inactive->label();

    $this->assertEquals('Pendente', $pendingLabel);
    $this->assertEquals('Ativo', $activeLabel);
    $this->assertEquals('Inativo', $inactiveLabel);
});

it('returns correct tag for each status', function () {
    $pendingTag = Status::Pending->tag();
    $activeTag = Status::Active->tag();
    $inactiveTag = Status::Inactive->tag();

    $this->assertEquals('<span class="badge bg-label-warning me-1">Pendente</span>', $pendingTag);
    $this->assertEquals('<span class="badge bg-label-primary me-1">Ativo</span>', $activeTag);
    $this->assertEquals('<span class="badge bg-label-danger me-1">Inativo</span>', $inactiveTag);
});
