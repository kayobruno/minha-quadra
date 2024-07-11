<?php

declare(strict_types=1);

namespace App\Enums;

use App\Traits\Enums;

enum InvoiceType: string
{
    use Enums;

    case Receiving = 'receiving';
    case Issuing = 'issuing';

    public function label(): string
    {
        return match ($this) {
            InvoiceType::Receiving => 'Entrada',
            InvoiceType::Issuing => 'Saída',
        };
    }
}
