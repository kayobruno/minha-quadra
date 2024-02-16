<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dash\Court\CreateRequest;
use App\Models\Court;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    public function index()
    {
        $courts = Court::paginate(10);

        return view('content.courts.index', compact('courts'));
    }

    public function create()
    {
        return view('content.courts.create');
    }

    public function store(CreateRequest $request)
    {
        $data = array_merge($request->all(), ['merchant_id' => auth()->user()->merchant_id]);
        Court::create($data);

        session()->flash('message', __('messages.success.created'));

        return redirect()->back();
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function delete(Court $court)
    {
        $court->delete();
        session()->flash('message', __('messages.success.removed'));

        return redirect()->back();
    }
}
