<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\Contracts\DataParam;
use App\Enums\BookingStatus;
use App\Traits\ToArray;
use DateTimeImmutable;
use Illuminate\Http\Request;

readonly class BookingDataParam implements DataParam
{
    use ToArray;

    public string $userId;
    public string $merchantId;

    public function __construct(
        public string $customerId,
        public string $courtId,
        public string $sport,
        public string $startDatetime,
        public string $endDatetime,
        public int $totalHours,
        public string $status,
        public ?string $note = null,
    ) {
        $this->userId = '1'; // TODO: Get from logged user
        $this->merchantId = '1'; // TODO: Get from logged user
    }

    public static function fromRequest(Request $request): self
    {
        $startTime = "{$request->input('when')} {$request->input('start_time')}:00";
        $endTime = "{$request->input('when')} {$request->input('end_time')}:00";

        $start = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $startTime);
        $end = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $endTime);
        $diff = $start->diff($end);
        $totalHours = $diff->h;

        return new self(
            (string) $request->input('customer_id'),
            (string) $request->input('court_id'),
            $request->input('sport'),
            $startTime,
            $endTime,
            $totalHours,
            BookingStatus::Confirm->value,
            $request->input('note'),
        );
    }
}
