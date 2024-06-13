<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\Contracts\DataParam;
use App\Traits\ToArray;
use Illuminate\Http\Request;

class CourtData implements DataParam
{
    use ToArray;

    public string $merchantId;

    public function __construct(
        public readonly string $name,
        public readonly ?string $color = null,
    ) {
        $this->merchantId = (string) auth()->user()->merchant_id;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('name'),
            $request->input('color'),
        );
    }
}
