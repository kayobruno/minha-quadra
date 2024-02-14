<?php

declare(strict_types=1);

namespace App\Utils\Validators;

class CPFValidator extends AbstractDocumentValidator
{
    private const CPF_LENGTH = 11;

    public function isValid(string $document): bool
    {
        $document = $this->removeMask($document);
        $digits = substr($document, 0, 9);

        $newDocument = $this->calculateDigitPosition($digits);
        $newDocument = $this->calculateDigitPosition($newDocument, self::CPF_LENGTH);

        return $document === $newDocument && $this->isSequenceValid($newDocument, self::CPF_LENGTH);
    }
}
