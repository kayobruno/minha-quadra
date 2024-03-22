<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Booking\CreateRequest;
use App\Http\Resources\Booking\BookingResource;
use App\Models\Booking;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $bookings = Booking::with('customer', 'user', 'court')
            ->where('start_datetime', '>=', $request->input('start'))
            ->where('end_datetime', '<=', $request->input('end'))
            ->orderBy('start_datetime', 'asc')
            ->get();

        return $this->success(BookingResource::collection($bookings));
    }

    public function show(Booking $booking): JsonResponse
    {
        return $this->success(new BookingResource($booking));
    }
}
