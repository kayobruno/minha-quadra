<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DataTransferObjects\BookingDataParam;
use App\Enums\BookingStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Booking\CreateRequest;
use App\Http\Resources\Booking\BookingResource;
use App\Models\Booking;
use App\Models\Customer;
use DateTimeImmutable;
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

    public function store(CreateRequest $request): JsonResponse
    {
        $data = $request->all();
        if (empty($data['customer_id'])) {
            $customer = Customer::create(['name' => $data['customer_name'], 'phone' => $data['customer_phone'], 'merchant_id' => 1]);
            $data['customer_id'] = $customer->id;
        }

        $startTime = "{$request->input('when')} {$request->input('start_time')}:00";
        $endTime = "{$request->input('when')} {$request->input('end_time')}:00";

        $bookings = Booking::where('court_id', $request->input('court_id'))
                      ->where('merchant_id', 1)
                      ->where(function ($query) use ($startTime, $endTime) {
                          $query->where(function ($q) use ($startTime) {
                              $q->where('start_datetime', '<=', $startTime)
                                ->where('end_datetime', '>', $startTime);
                          })
                                ->orWhere(function ($q) use ($endTime) {
                                    $q->where('start_datetime', '<', $endTime)
                                      ->where('end_datetime', '>=', $endTime);
                                })
                                ->orWhere(function ($q) use ($startTime, $endTime) {
                                    $q->where('start_datetime', '>=', $startTime)
                                      ->where('end_datetime', '<=', $endTime);
                                });
                      })
                    ->exists();

        if ($bookings) {
            return $this->badRequest([
                'start_time' => [__('messages.validation.unavailable', ['field' => 'horário'])],
            ]);
        }

        $bookingDataParam = new BookingDataParam(
            '1',
            '1',
            $data['customer_id'],
            $data['court_id'],
            $data['sport'],
            (new DateTimeImmutable($startTime))->format('Y-m-d H:i:s'),
            (new DateTimeImmutable($endTime))->format('Y-m-d H:i:s'),
            2,
            BookingStatus::Confirm->value
        );

        $booking = Booking::create($bookingDataParam->toArray());

        return $this->success(new BookingResource($booking));
    }
}
