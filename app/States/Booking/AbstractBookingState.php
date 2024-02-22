<?php

declare(strict_types=1);

namespace App\States\Booking;

use App\Contracts\BookingState;

abstract class AbstractBookingState implements BookingState
{
    public function confirm(): void
    {
        throw new \DomainException('Esta reserva não pode ser confirmada!');
    }

    public function cancel(): void
    {
        throw new \DomainException('Esta reserva não pode ser cancelada!');
    }

    public function finish(): void
    {
        throw new \DomainException('Esta reserva não pode ser finalizada!');
    }

    public function progress(): void
    {
        throw new \DomainException('Esta reserva não pode ser processada!');
    }

    public function expire(): void
    {
        throw new \DomainException('Esta reserva não pode ser expirada!');
    }
}
