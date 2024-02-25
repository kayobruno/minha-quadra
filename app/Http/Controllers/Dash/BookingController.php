<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dash;

use App\Enums\BookingStatus;
use App\Enums\Sport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dash\Booking\CreateRequest;
use App\Http\Requests\Dash\Booking\UpdateRequest;
use App\Models\Booking;
use App\Models\Court;
use App\Models\Customer;
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('customer', 'user', 'court')
            ->orderBy('start_datetime', 'asc')
            ->paginate(10);

        return view('content.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $statuses = BookingStatus::getInitialStatuses();
        $customers = Customer::get();
        $courts = Court::get();
        $sports = Sport::cases();

        return view('content.bookings.create', compact('statuses', 'customers', 'courts', 'sports'));
    }

    public function store(CreateRequest $request)
    {
        $data = array_merge($request->all(), ['merchant_id' => auth()->user()->merchant_id, 'user_id' => auth()->user()->id]);
        $data['start_datetime'] = Carbon::createFromFormat('d/m/Y H:i', $data['start_datetime']);
        $endDatetime = clone $data['start_datetime'];
        $data['end_datetime'] = $endDatetime->setHour($data['end_datetime']);
        $data['total_hours'] = $data['start_datetime']->diffInHours($data['end_datetime']);

        Booking::create($data);

        session()->flash('message', __('messages.success.created'));

        return redirect()->back();
    }

    public function edit(Booking $booking)
    {
        $statuses = [...BookingStatus::getInitialStatuses(), BookingStatus::Canceled];
        $customers = Customer::get();
        $courts = Court::get();
        $sports = Sport::cases();

        return view('content.bookings.edit', compact('statuses', 'customers', 'courts', 'sports', 'booking'));
    }

    public function update(UpdateRequest $request, Booking $booking)
    {
        $data = $request->all();
        $startDatetime = Carbon::parse($data['start_datetime']);
        $endDatetime = Carbon::parse($data['end_datetime']);
        $data['total_hours'] = $startDatetime->diffInHours($endDatetime);

        $booking->update($data);
        session()->flash('message', __('messages.success.updated'));

        return redirect()->back();
    }
}
