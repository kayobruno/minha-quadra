<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DataTransferObjects\BookingDataParam;
use App\DataTransferObjects\CustomerDataParam;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Booking\CreateRequest;
use App\Http\Resources\Booking\BookingResource;
use App\Models\Booking;
use App\Services\BookingService;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request, BookingService $bookingService): JsonResponse
    {
        $bookings = $bookingService->getBookingsBetweenDates($request->input('start'), $request->input('end'));

        return $this->success(BookingResource::collection($bookings));
    }

    public function show(Booking $booking): JsonResponse
    {
        return $this->success(new BookingResource($booking));
    }

    public function createOrUpdate(CreateRequest $request, CustomerService $customerService, BookingService $bookingService): JsonResponse
    {
        if (empty($request->input('customer_id'))) {
            $customerDataParam = CustomerDataParam::fromRequest($request);
            $customer = $customerService->createCustomer($customerDataParam);
            $request->merge(['customer_id' => $customer->id]);
        }

        $bookingDataParam = BookingDataParam::fromRequest($request);
        if ($bookingService->hasConflictBetweenBookings($bookingDataParam)) {
            return $this->badRequest([
                'start_time' => [__('messages.validation.unavailable', ['field' => 'horário'])],
            ]);
        }

        $booking = $bookingService->createBooking($bookingDataParam);

        return $this->success(new BookingResource($booking));
    }
}
