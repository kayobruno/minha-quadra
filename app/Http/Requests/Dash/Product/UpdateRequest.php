<?php

declare(strict_types=1);

namespace App\Http\Requests\Dash\Product;

use Illuminate\Validation\Rule;

class UpdateRequest extends CreateRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|max:255',
            'price' => 'required|min:0',
        ];

        $product = $this->route('product');
        if ($this->input('ean') !== $product->ean) {
            $rules['ean'] = [
                'nullable',
                'string',
                'max:255',
                Rule::unique('products')->where(function ($query) {
                    $merchantId = auth()->user()->merchant_id;

                    return $query->where('merchant_id', $merchantId);
                }),
            ];
        }

        return $rules;
    }
}
