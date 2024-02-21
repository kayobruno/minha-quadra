<?php

declare(strict_types=1);

namespace App\Http\Requests\Dash\Booking;

use App\Enums\BookingStatus;
use App\Enums\Sport;
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
            'customer_id' => 'required|exists:customers,id',
            'court_id' => 'required|exists:courts,id',
            'sport' => ['required', Rule::in(Sport::all())],
            'status' => ['required', Rule::in(BookingStatus::all())],
            'start_datetime' => 'required|date|after:now',
            'end_datetime' => 'required|after:start_datetime',
        ];
    }

    public function attributes(): array
    {
        return [
            'customer_id' => 'cliente',
            'court_id' => 'quadra',
            'sport' => 'esporte',
            'start_datetime' => 'data e horário de início',
            'end_datetime' => 'horário final',
        ];
    }
}
