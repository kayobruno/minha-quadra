<?php

declare(strict_types=1);

namespace App\Http\Requests\Dash\Product;

class UpdateRequest extends CreateRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $product = $this->route('product');

        return [
            'name' => 'required|max:255',
            'price' => 'required|min:0',
            'ean' => ['nullable', 'string', 'unique:products,ean,' . $product->id],
        ];
    }
}
