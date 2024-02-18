<?php

declare(strict_types=1);

namespace App\Enums;

enum BookingStatus: string
{
    case Pending = 'pending';
    case Confirm = 'confirm';
    case Canceled = 'canceled';
    case Finished = 'finished';
    case Progress = 'progress';
    case Expired = 'expired';

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
            self::Finished => 'Finalizado',
            self::Progress => 'Em Andamento',
            self::Expired => 'Expirado',
        };
    }

    public function tag(): string
    {
        return match ($this) {
            self::Pending => '<span class="badge bg-label-warning me-1">Pendente</span>',
            self::Confirm => '<span class="badge bg-label-success me-1">Confirmado</span>',
            self::Canceled => '<span class="badge bg-label-danger me-1">Cancelado</span>',
            self::Finished => '<span class="badge bg-label-primary me-1">Finalizado</span>',
            self::Progress => '<span class="badge bg-label-info me-1">Em Andamento</span>',
            self::Expired => '<span class="badge bg-label-secondary me-1">Expirado</span>',
        };
    }
}
