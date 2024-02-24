<?php

declare(strict_types=1);

namespace App\Http\Requests\Dash\Merchant;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'trade_name' => 'nullable|min:6|max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            'trade_name' => 'Razão Social',
        ];
    }
}
