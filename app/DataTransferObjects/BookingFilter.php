<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Illuminate\Http\Request;

readonly class BookingFilter
{
    public string $merchantId;

    public function __construct(
        public string $courtId,
        public string $startDatetime,
        public string $endDatetime,
        public ?string $bookingId = null,
        public ?string $sport = null,
        public ?string $status = null,
    ) {
        $this->merchantId = '1'; // TODO: Get from logged user
    }

    public static function fromRequest(Request $request): self
    {
        $startTime = "{$request->input('when')} {$request->input('start_time')}:00";
        $endTime = "{$request->input('when')} {$request->input('end_time')}:00";

        return new self(
            $request->input('court_id'),
            $startTime,
            $endTime,
            $request->input('booking_id'),
            $request->input('sport'),
            $request->input('status')
        );
    }
}
