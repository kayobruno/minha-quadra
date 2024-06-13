<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dash;

use App\DataTransferObjects\CourtData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dash\Court\CreateRequest;
use App\Http\Requests\Dash\Court\UpdateRequest;
use App\Models\Court;
use App\Services\CourtService;

class CourtController extends Controller
{
    public function __construct(private readonly CourtService $courtService)
    {
    }

    public function index()
    {
        $courts = $this->courtService->paginate();

        return view('content.courts.index', compact('courts'));
    }

    public function create()
    {
        return view('content.courts.create');
    }

    public function store(CreateRequest $request)
    {
        $courtData = CourtData::fromRequest($request);
        $this->courtService->save($courtData);

        session()->flash('message', __('messages.success.created'));

        return redirect()->back();
    }

    public function edit(Court $court)
    {
        return view('content.courts.edit', compact('court'));
    }

    public function update(UpdateRequest $request, Court $court)
    {
        $courtData = CourtData::fromRequest($request);
        $this->courtService->update($court->id, $courtData);

        session()->flash('message', __('messages.success.updated'));

        return redirect()->back();
    }

    public function delete(Court $court)
    {
        $this->courtService->delete($court->id);
        session()->flash('message', __('messages.success.removed'));

        return redirect()->back();
    }
}
