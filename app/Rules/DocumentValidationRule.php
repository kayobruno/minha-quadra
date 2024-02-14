<?php

declare(strict_types=1);

namespace App\Rules;

use App\Services\DocumentValidatorService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DocumentValidationRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $documentValidationService = new DocumentValidatorService;
        if (!$documentValidationService->isValid($value)) {
            $fail('The :attribute is invalid.');
        }
    }
}
