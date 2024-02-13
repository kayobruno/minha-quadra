<?php

declare(strict_types=1);

namespace App\Enums;

enum DocumentType: string
{
    case CPF = 'cpf';
    case CNPJ = 'cnpj';

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
            self::CPF => 'Pessoa Física',
            self::CNPJ => 'Pessoa Jurídica',
        };
    }
}
