<?php

declare(strict_types=1);

namespace App\Traits;

trait Enums
{
    public static function all(): array
    {
        $data = [];
        foreach (self::cases() as $type) {
            $data[] = $type->value;
        }

        return $data;
    }
}
