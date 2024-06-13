<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DataTransferObjects\BookingDataParam;
use App\DataTransferObjects\BookingFilter;
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
        try {
            $bookings = $bookingService->getBookingsBetweenDates($request->input('start'), $request->input('end'));

            return $this->success(BookingResource::collection($bookings));
        } catch (\Exception) {
            return $this->buildUnavailableResponse();
        }
    }

    public function show(Booking $booking): JsonResponse
    {
        try {
            return $this->success(new BookingResource($booking));
        } catch (\Exception) {
            return $this->buildUnavailableResponse();
        }
    }

    public function createOrUpdate(CreateRequest $request, CustomerService $customerService, BookingService $bookingService): JsonResponse
    {
        try {
            $bookingFilter = BookingFilter::fromRequest($request);
            if ($bookingService->hasConflictBetweenBookings($bookingFilter)) {
                return $this->badRequest([
                    'start_time' => [__('messages.validation.unavailable', ['field' => 'horário'])],
                ]);
            }

            if (empty($request->input('customer_id'))) {
                $customerDataParam = CustomerDataParam::fromRequest($request);
                $customer = $customerService->save($customerDataParam);
                $request->merge(['customer_id' => $customer->id]);
            }

            $bookingDataParam = BookingDataParam::fromRequest($request);
            if ($request->input('booking_id') && is_numeric($request->input('booking_id'))) {
                $booking = $bookingService->updateBooking($bookingDataParam, $request->input('booking_id'));
            } else {
                $booking = $bookingService->createBooking($bookingDataParam);
            }

            return $this->success(new BookingResource($booking));
        } catch (\LogicException $e) {
            return $this->badRequest(['error' => [$e->getMessage()]]);
        } catch (\Exception) {
            return $this->buildUnavailableResponse();
        }
    }

    public function cancel(Booking $booking, BookingService $bookingService): JsonResponse
    {
        try {
            if (!$bookingService->canUpdateBooking($booking)) {
                return $this->badRequest(['error' => [__('messages.validation.notallowed')]]);
            }

            $bookingService->cancelBooking((string) $booking->id);

            return $this->success(new BookingResource($booking));
        } catch (\Exception) {
            return $this->buildUnavailableResponse();
        }
    }
}
