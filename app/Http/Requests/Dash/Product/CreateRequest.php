<?php

declare(strict_types=1);

namespace App\Http\Requests\Dash\Product;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'price' => 'required|min:0',
            'ean' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('products')->where(function ($query) {
                    $merchantId = auth()->user()->merchant_id;
                    return $query->where('merchant_id', $merchantId);
                }),
            ],
        ];
    }
}
