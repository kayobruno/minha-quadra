<?php

declare(strict_types=1);

namespace App\Http\Requests\Dash\Invoice;

use App\Enums\InvoiceType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'type' => ['required', Rule::in(InvoiceType::all())],
            'serie' => [
                'required',
                'max:255',
                $this->uniqueInvoiceRule(),
            ],
            'number' => [
                'required',
                'max:255',
                $this->uniqueInvoiceRule(),
            ],
        ];
    }

    protected function uniqueInvoiceRule(): \Illuminate\Validation\Rules\Unique
    {
        return Rule::unique('invoices')->where(function ($query) {
            $merchantId = auth()->user()->merchant_id;

            return $query->where('merchant_id', $merchantId);
        });
    }
}
