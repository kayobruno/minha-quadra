<?php

declare(strict_types=1);

namespace App\Http\Requests\Dash\Supplier;

use App\Rules\DocumentValidationRule;
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
            'document' => ['required', 'max:18', new DocumentValidationRule],
            'type' => 'required|in:cpf,cnpj',
        ];
    }

    public function messages(): array
    {
        return [
            'document' => 'Documento inválido!',
        ];
    }
}
