<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\Traits\ToArray;

readonly class BookingDataParam
{
    use ToArray;

    public function __construct(
        public string $userId,
        public string $merchantId,
        public string $customerId,
        public string $courtId,
        public string $sport,
        public string $startDatetime,
        public string $endDatetime,
        public int $totalHours,
        public string $status,
        public ?string $note = null,
    ) {
    }
}
