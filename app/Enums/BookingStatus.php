<?php

declare(strict_types=1);

namespace App\Enums;

enum BookingStatus: string
{
    case Confirm = 'confirm';
    case Canceled = 'canceled';
    case Finished = 'finished';
    case Progress = 'progress';

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
            self::Confirm => 'Confirmado',
            self::Canceled => 'Cancelado',
            self::Finished => 'Finalizado',
            self::Progress => 'Em Andamento',
        };
    }

    public function tag(): string
    {
        return match ($this) {
            self::Confirm => '<span class="badge bg-label-success me-1">Confirmado</span>',
            self::Canceled => '<span class="badge bg-label-danger me-1">Cancelado</span>',
            self::Finished => '<span class="badge bg-label-primary me-1">Finalizado</span>',
            self::Progress => '<span class="badge bg-label-info me-1">Em Andamento</span>',
        };
    }

    public function isEditable(): bool
    {
        return match ($this) {
            self::Progress, self::Confirm => true,
            default => false,
        };
    }
}
