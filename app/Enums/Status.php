<?php

declare(strict_types=1);

namespace App\Enums;

enum Status: string
{
    case Pending = 'pending';
    case Active = 'active';
    case Inactive = 'inactive';

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
            Status::Pending => 'Pendente',
            Status::Active => 'Ativo',
            Status::Inactive => 'Inativo',
        };
    }

    public function tag(): string
    {
        return match ($this) {
            Status::Pending => '<span class="badge bg-label-warning me-1">Pendente</span>',
            Status::Active => '<span class="badge bg-label-primary me-1">Ativo</span>',
            Status::Inactive => '<span class="badge bg-label-danger me-1">Inativo</span>',
        };
    }
}
