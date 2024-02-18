<?php

declare(strict_types=1);

namespace App\Enums;

enum BookingStatus: string
{
    case Pending = 'pending';
    case Confirm = 'confirm';
    case Canceled = 'canceled';

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
            self::Confirm => 'Confirmado',
            self::Canceled => 'Cancelado',
        };
    }

    public function tag(): string
    {
        return match ($this) {
            self::Pending => '<span class="badge bg-label-warning me-1">Pendente</span>',
            self::Confirm => '<span class="badge bg-label-success me-1">Confirmado</span>',
            self::Canceled => '<span class="badge bg-label-danger me-1">Cancelado</span>',
        };
    }
}
