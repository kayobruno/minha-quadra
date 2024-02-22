<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\BookingStatus;
use App\Models\Booking;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class ExpirePendingBooking extends Command
{
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
        $currentDateTime = Carbon::now();
        Booking::where('status', BookingStatus::Pending->value)
            ->where('start_datetime', '<=', $currentDateTime)
            ->update(['status' => BookingStatus::Expired->value]);
    }
}
