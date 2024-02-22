<?php

declare(strict_types=1);

namespace App\Contracts;

interface BookingState
{
    public function confirm(): void;

    public function cancel(): void;

    public function finish(): void;

    public function progress(): void;

    public function expire(): void;
}
