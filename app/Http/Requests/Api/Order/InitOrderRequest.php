<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Order;

use App\Http\Requests\Api\BaseRequest;

class InitOrderRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'tab' => 'nullable|integer|min:1',
        ];
    }
}
