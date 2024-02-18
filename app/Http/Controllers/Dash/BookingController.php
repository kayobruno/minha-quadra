<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dash;

use App\Enums\BookingStatus;
use App\Http\Controllers\Controller;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('customer', 'user', 'court')
            ->whereDate('when', '>', now())
            ->whereNotIn('status', [BookingStatus::Canceled, BookingStatus::Expired, BookingStatus::Finished])
            ->orderBy('when', 'asc')
            ->paginate(10);

        return view('content.bookings.index', compact('bookings'));
    }
}
