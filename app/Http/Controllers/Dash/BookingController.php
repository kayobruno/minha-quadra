<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dash;

use App\Enums\Sport;
use App\Http\Controllers\Controller;
use App\Models\Court;

class BookingController extends Controller
{
    public function index()
    {
        $courts = Court::get();
        $sports = Sport::cases();

        return view('content.bookings.index', compact('courts', 'sports'));
    }
}
