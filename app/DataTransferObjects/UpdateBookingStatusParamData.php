<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\Enums\BookingStatus;

readonly class UpdateBookingStatusParamData
{
    public function __construct(
        public BookingStatus $initialStatus,
        public BookingStatus $finalStatus,
        public string $whereField,
        public string $whereCondition,
        public mixed $whereValue,
    ) {
    }
}
