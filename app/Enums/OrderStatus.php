<?php

declare(strict_types=1);

namespace App\Enums;

enum OrderStatus: string
{
    case Pending = 'pending';
    case Paid = 'paid';
    case Cancelled = 'cancelled';

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
            self::Pending => 'Pendente',
            self::Paid => 'Ativo',
            self::Cancelled => 'Inativo',
        };
    }

    public function tag(): string
    {
        return match ($this) {
            self::Pending => '<span class="badge bg-label-warning me-1">Pendente</span>',
            self::Paid => '<span class="badge bg-label-primary me-1">Pago</span>',
            self::Cancelled => '<span class="badge bg-label-danger me-1">Cancelado</span>',
        };
    }
}
