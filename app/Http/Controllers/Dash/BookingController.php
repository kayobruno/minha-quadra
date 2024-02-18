<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('customer', 'user', 'court')->paginate(10);

        return view('content.bookings.index', compact('bookings'));
    }
}
