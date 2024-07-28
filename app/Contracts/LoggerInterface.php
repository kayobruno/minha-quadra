<?php

declare(strict_types=1);

namespace App\Contracts;

interface LoggerInterface
{
    public function log(array $data): void;
}
