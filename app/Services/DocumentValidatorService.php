<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\DocumentType;
use App\Utils\Validators\CNPJValidator;
use App\Utils\Validators\CPFValidator;

class DocumentValidatorService
{
    public function isValid(string $document, DocumentType $documentType): bool
    {
        return match ($documentType) {
            DocumentType::CPF => (new CPFValidator)->isValid($document),
            DocumentType::CNPJ => (new CNPJValidator)->isValid($document),
        };
    }
}
