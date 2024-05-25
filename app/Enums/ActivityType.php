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
}
