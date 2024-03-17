<?php

declare(strict_types=1);

namespace App\Enums;

enum Sport: string
{
    case Volleyball = 'volleyball';
    case BeachTennis = 'beachtennis';
    case Footvolley = 'footvolley';

    public static function all(): array
    {
        $data = [];
        foreach (self::cases() as $status) {
            $data[] = $status->value;
        }

        return $data;
    }

    public function label(): string
    {
        return match ($this) {
            self::Volleyball => 'Vôlei',
            self::BeachTennis => 'Beach Tennis',
            self::Footvolley => 'Futevôlei',
        };
    }

    public function tag(): string
    {
        return match ($this) {
            self::Volleyball => '<span class="badge bg-label-primary me-1"><i class="bx-tada-hover bx bx-basketball" title="Vôlei"></i></span>',
            self::BeachTennis => '<span class="badge bg-label-info me-1"><i class="bx-tada-hover bx bx-tennis-ball" title="Beach Tennis"></i></span>',
            self::Footvolley => '<span class="badge bg-label-success me-1"><i class="bx-tada-hover bx bx-football" title="Futevôlei"></i></span>',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Volleyball => '<i class="bx-tada-hover bx bx-basketball" title="Vôlei"></i>',
            self::BeachTennis => '<i class="bx-tada-hover bx bx-tennis-ball" title="Beach Tennis"></i>',
            self::Footvolley => '<i class="bx-tada-hover bx bx-football" title="Futevôlei"></i>',
        };
    }
}
