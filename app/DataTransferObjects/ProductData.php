<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\Contracts\DataParam;
use App\Enums\ProductType;
use App\Enums\Status;
use App\Traits\ToArray;
use Illuminate\Http\Request;

class ProductData implements DataParam
{
    use ToArray;

    public string $merchantId;

    public function __construct(
        public readonly string $name,
        public readonly string $price,
        public readonly ?string $description,
        public readonly ProductType $type,
        public readonly ?string $ean,
        public readonly bool $manageStock,
        public readonly Status $status,
    ) {
        $this->merchantId = auth()->user()->merchant_id;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('name'),
            $request->input('price'),
            $request->input('description'),
            ProductType::from($request->input('type', 'product')),
            $request->input('ean'),
            (bool) $request->input('manage_stock', false),
            Status::from($request->input('status', 'pending')),
        );
    }
}
