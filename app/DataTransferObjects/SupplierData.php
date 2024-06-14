<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\Contracts\DataParam;
use App\Enums\DocumentType;
use App\Traits\ToArray;
use Illuminate\Http\Request;

class SupplierData implements DataParam
{
    use ToArray;

    public string $merchantId;

    public function __construct(
        public readonly string $name,
        public readonly string $document,
        public readonly DocumentType $type,
    ) {
        $this->merchantId = auth()->user()->merchant_id;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('name'),
            $request->input('document'),
            DocumentType::from($request->input('type')),
        );
    }
}
