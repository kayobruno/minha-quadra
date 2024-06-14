<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\Contracts\DataParam;
use App\Traits\ToArray;
use Illuminate\Http\Request;

class MerchantData implements DataParam
{
    use ToArray;

    public string $merchantId;

    public function __construct(
        public readonly string $tradeName,
        public readonly string $phone,
        public readonly string $address,
        public readonly ?string $logo,
    ) {
        $this->merchantId = (string) auth()->user()->merchant_id;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('trade_name'),
            $request->input('phone'),
            $request->input('address'),
            $request->input('logo'),
        );
    }
}
