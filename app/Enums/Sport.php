<?php

declare(strict_types=1);

namespace App\Enums;

enum Sport: string
{
    case Volleyball = 'volleyball';
    case BeachTennis = 'beachtennis';
    case Footvolley = 'Footvolley';

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
}
