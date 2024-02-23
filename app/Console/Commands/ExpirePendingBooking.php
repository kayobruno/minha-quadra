<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\DataTransferObjects\UpdateBookingStatusParamData;
use App\Enums\BookingStatus;
use App\Services\UpdateBookingStatusService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class ExpirePendingBooking extends Command
{
    public function __construct(private UpdateBookingStatusService $updateBookingStatusService)
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expire-pending-booking';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire pending reservations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $updateBookingStatusParamData = new UpdateBookingStatusParamData(
            initialStatus: BookingStatus::Pending,
            finalStatus: BookingStatus::Expired,
            whereField: 'start_datetime',
            whereCondition: '<=',
            whereValue: Carbon::now(),
        );

        $this->updateBookingStatusService->execute($updateBookingStatusParamData);
    }
}
