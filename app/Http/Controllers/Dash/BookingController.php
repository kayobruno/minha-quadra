<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dash;

use App\Enums\BookingStatus;
use App\Enums\Sport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dash\Booking\CreateRequest;
use App\Models\Booking;
use App\Models\Court;
use App\Models\Customer;

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

    public function create()
    {
        $statuses = BookingStatus::cases();
        $customers = Customer::get();
        $courts = Court::get();
        $sports = Sport::cases();

        return view('content.bookings.create', compact('statuses', 'customers', 'courts', 'sports'));
    }

    public function store(CreateRequest $request)
    {
        $data = array_merge($request->all(), ['merchant_id' => auth()->user()->merchant_id, 'user_id' => auth()->user()->id]);
        Booking::create($data);

        session()->flash('message', __('messages.success.created'));

        return redirect()->back();
    }
}
