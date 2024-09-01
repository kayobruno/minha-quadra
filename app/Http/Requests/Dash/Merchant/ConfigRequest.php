<?php

declare(strict_types=1);

namespace App\Http\Requests\Dash\Merchant;

use Illuminate\Foundation\Http\FormRequest;

class ConfigRequest extends FormRequest
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
            'configs' => 'required|array',
            'configs.*' => 'required|string|max:255',
            'configs.tag_total' => 'integer|min:0',
            'configs.min_hours_reserve' => 'integer|min:1',
        ];
    }
}
