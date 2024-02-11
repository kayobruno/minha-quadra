<?php

declare(strict_types=1);

namespace App\Enums;

enum ProductType: string
{
    case Product = 'product';
    case Service = 'service';

    public static function all(): array
    {
        $data = [];
        foreach (self::cases() as $type) {
            $data[] = $type->value;
        }

        return $data;
    }

    public function label(): string
    {
        return match ($this) {
            self::Product => 'Produto',
            self::Service => 'Serviço',
        };
    }
}
