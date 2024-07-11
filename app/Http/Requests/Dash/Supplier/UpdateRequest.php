<?php

declare(strict_types=1);

namespace App\Http\Requests\Dash\Supplier;

use App\Rules\DocumentValidationRule;
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
            'document' => [
                'required',
                'max:18',
                new DocumentValidationRule,
            ],
            'type' => 'required|in:cpf,cnpj',
        ];

        $supplier = $this->route('supplier');
        if ($this->input('document') !== $supplier->document) {
            $rules['document'][] = Rule::unique('suppliers')->where(function ($query) {
                $merchantId = auth()->user()->merchant_id;

                return $query->where('merchant_id', $merchantId);
            });
        }

        return $rules;
    }
}
