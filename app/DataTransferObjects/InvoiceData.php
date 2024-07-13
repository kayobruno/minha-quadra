<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\Contracts\DataParam;
use App\Enums\InvoiceType;
use App\Traits\ToArray;
use Illuminate\Http\Request;

class InvoiceData implements DataParam
{
    use ToArray;

    public string $merchantId;

    public function __construct(
        public readonly InvoiceType $type,
        public readonly string $serie,
        public readonly string $number,
    ) {
        $this->merchantId = auth()->user()->merchant_id;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            type: InvoiceType::from($request->input('type', InvoiceType::Issuing)),
            serie: $request->input('serie'),
            number: $request->input('number'),
        );
    }
}
