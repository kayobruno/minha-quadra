<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dash;

use App\Enums\Sport;
use App\Http\Controllers\Controller;
use App\Services\CourtService;

class BookingController extends Controller
{
    public function __construct(private readonly CourtService $courtService)
    {
    }

    public function index()
    {
        $courts = $this->courtService->getAll();
        $sports = Sport::cases();

        return view('content.bookings.index', compact('courts', 'sports'));
    }
}
