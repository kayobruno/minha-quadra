<?php

declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\UpdateBookingStatusParamData;
use App\Models\Booking;

class UpdateBookingStatusService
{
    public function execute(UpdateBookingStatusParamData $updateBookingStatusParamData): void
    {
        Booking::where('status', $updateBookingStatusParamData->initialStatus->value)
            ->where($updateBookingStatusParamData->whereField, $updateBookingStatusParamData->whereCondition, $updateBookingStatusParamData->whereValue)
            ->update(['status' => $updateBookingStatusParamData->finalStatus->value]);
    }
}
