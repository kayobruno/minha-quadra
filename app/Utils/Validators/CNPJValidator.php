<?php

declare(strict_types=1);

namespace App\Utils\Validators;

class CNPJValidator extends AbstractDocumentValidator
{
    private const CNPJ_LENGTH = 14;

    public function isValid(string $document): bool
    {
        $document = $this->removeMask($document);
        $digits = substr($document, 0, 12);

        $firstCalc = $this->calculateDigitPosition(digits: $digits, positions: 5);
        $newDocument = $this->calculateDigitPosition(digits: $firstCalc, positions: 6);

        return $newDocument === $document && $this->isSequenceValid($document, self::CNPJ_LENGTH);
    }
}
