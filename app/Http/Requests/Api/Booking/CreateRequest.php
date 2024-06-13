<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Booking;

use App\Enums\Sport;
use App\Http\Requests\Api\BaseRequest;
use App\Rules\TimeBeforeRule;
use Illuminate\Validation\Rule;

class CreateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'court_id' => 'required|exists:courts,id',
            'name' => 'required|max:255',
            'phone' => ['nullable', 'max:16'],
            'when' => ['required', 'date_format:Y-m-d', 'after_or_equal:today'],
            'start_time' => ['required', 'date_format:H:i', new TimeBeforeRule('end_time', $this->input('when') ?? '')],
            'end_time' => ['required', 'date_format:H:i'],
            'sport' => ['required', Rule::in(Sport::all())],
            'note' => 'nullable',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'phone' => 'telefone',
            'when' => 'data',
            'start_time' => 'hora inicial',
            'end_time' => 'hora final',
            'court_id' => 'quadra',
            'sport' => 'modalidade',
            'note' => 'observações',
        ];
    }
}
