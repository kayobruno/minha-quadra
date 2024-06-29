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
            name: $request->input('name'),
            price: self::sanitizePrice($request->input('price', '0.00')),
            description: $request->input('description'),
            type: ProductType::from($request->input('type', 'product')),
            ean: $request->input('ean'),
            manageStock: (bool) $request->input('manage_stock', false),
            status: Status::from($request->input('status', 'pending')),
        );
    }

    private static function sanitizePrice(string $price): string
    {
        $price = str_replace('.', '', $price);

        return str_replace(',', '.', $price);
    }
}
