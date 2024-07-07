<?php

declare(strict_types=1);

use App\Enums\Sport;

it('returns all sports', function () {
    $expected = ['volleyball', 'beachtennis', 'footvolley'];
    $actual = Sport::all();

    $this->assertEquals($expected, $actual);
});

it('returns correct label for each sport', function () {
    $volleyballLabel = Sport::Volleyball->label();
    $beachTennisLabel = Sport::BeachTennis->label();
    $footvolleyLabel = Sport::Footvolley->label();

    $this->assertEquals('Vôlei', $volleyballLabel);
    $this->assertEquals('Beach Tennis', $beachTennisLabel);
    $this->assertEquals('Futevôlei', $footvolleyLabel);
});

it('returns correct tag for each sport', function () {
    $volleyballTag = Sport::Volleyball->tag();
    $beachTennisTag = Sport::BeachTennis->tag();
    $footvolleyTag = Sport::Footvolley->tag();

    $this->assertEquals('<span class="badge bg-label-primary me-1"><i class="bx-tada-hover bx bx-basketball" title="Vôlei"></i></span>', $volleyballTag);
    $this->assertEquals('<span class="badge bg-label-info me-1"><i class="bx-tada-hover bx bx-tennis-ball" title="Beach Tennis"></i></span>', $beachTennisTag);
    $this->assertEquals('<span class="badge bg-label-success me-1"><i class="bx-tada-hover bx bx-football" title="Futevôlei"></i></span>', $footvolleyTag);
});

it('returns correct icon for each sport', function () {
    $volleyballIcon = Sport::Volleyball->icon();
    $beachTennisIcon = Sport::BeachTennis->icon();
    $footvolleyIcon = Sport::Footvolley->icon();

    $this->assertEquals('<i class="bx-tada-hover bx bx-basketball" title="Vôlei"></i>', $volleyballIcon);
    $this->assertEquals('<i class="bx-tada-hover bx bx-tennis-ball" title="Beach Tennis"></i>', $beachTennisIcon);
    $this->assertEquals('<i class="bx-tada-hover bx bx-football" title="Futevôlei"></i>', $footvolleyIcon);
});
