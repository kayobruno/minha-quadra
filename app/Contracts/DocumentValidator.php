<?php

declare(strict_types=1);

namespace App\Contracts;

interface DocumentValidator
{
    public function isValid(string $document): bool;
}
