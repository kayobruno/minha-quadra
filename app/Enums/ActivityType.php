<?php

declare(strict_types=1);

namespace App\Enums;

enum ActivityType: string
{
    case StartOrder = 'start-order';
    case AddItem = 'add-item';
    case RemoveItem = 'remove-item';
    case UpdateItem = 'update-item';
    case PartialPayment = 'partial-payment';
    case FinishOrder = 'finish-order';

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
            self::StartOrder => 'Pedido Iniciado',
            self::AddItem => 'Item Adicionado',
            self::RemoveItem => 'Item Removido',
            self::UpdateItem => 'Item Atualizado',
            self::PartialPayment => 'Pagamento Parcial Realizado',
            self::FinishOrder => 'Pedido Finalizado',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::StartOrder => 'secondary',
            self::AddItem => 'primary',
            self::RemoveItem => 'danger',
            self::UpdateItem => 'warning',
            self::PartialPayment => 'info',
            self::FinishOrder => 'success',
        };
    }
}
