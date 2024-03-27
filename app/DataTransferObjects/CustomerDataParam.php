<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\Contracts\DataParam;
use App\Traits\ToArray;
use Illuminate\Http\Request;

readonly class CustomerDataParam implements DataParam
{
    use ToArray;

    public string $merchantId;

    public function __construct(
        public string $name,
        public string $phone,
    ) {
        $this->merchantId = '1'; // TODO: Get from user logged
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('customer_name'),
            $request->input('customer_phone'),
        );
    }
}
