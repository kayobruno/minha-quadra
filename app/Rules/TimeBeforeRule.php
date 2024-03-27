<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TimeBeforeRule implements ValidationRule
{
    public function __construct(protected string $endTimeField)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $endTime = request()->input($this->endTimeField);
        if (strtotime($value) >= strtotime($endTime)) {
            $fail(__('messages.validation.time.before'));
        }

        if (strtotime($value) < strtotime(date('H:m'))) {
            $fail(__('messages.validation.time.past'));
        }
    }
}
