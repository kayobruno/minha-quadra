<?php

declare(strict_types=1);

namespace App\Services;

use App\Utils\Validators\CNPJValidator;
use App\Utils\Validators\CPFValidator;

class DocumentValidatorService
{
    private const PATTERN_TO_REMOVE_MASK = '/[^0-9]/';
    private const CPF_LENGTH = 11;
    private const CNPJ_LENGTH = 14;

    public function isValid(string $document): bool
    {
        $document = preg_replace(self::PATTERN_TO_REMOVE_MASK, '', $document);

        return match (strlen($document)) {
            self::CPF_LENGTH => (new CPFValidator)->isValid($document),
            self::CNPJ_LENGTH => (new CNPJValidator)->isValid($document),
            default => false,
        };
    }
}
