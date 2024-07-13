<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\Contracts\DataParam;
use App\Enums\OrderStatus;
use App\Traits\ToArray;
use Illuminate\Http\Request;

readonly class OrderDataParam implements DataParam
{
    use ToArray;

    public string $userId;
    public string $merchantId;

    public function __construct(
        public string $customerId,
        public OrderStatus $status,
        public ?string $paymentMethodId = null,
        public string $discount = '0.0',
        public string $tab = '',
        public ?string $note = null,
    ) {
        $this->userId = auth()->user()->id;
        $this->merchantId = auth()->user()->merchant_id;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            (string) $request->input('customer_id'),
            OrderStatus::Pending,
            (string) $request->input('payment_method_id'),
            $request->input('discount'),
            $request->input('tab'),
            $request->input('note'),
        );
    }
}
