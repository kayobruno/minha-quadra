<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dash\Merchant\UpdateRequest;

class MyMerchantController extends Controller
{
    public function edit()
    {
        $merchant = auth()->user()->merchant;

        return view('content.merchants.edit', compact('merchant'));
    }

    public function update(UpdateRequest $request)
    {
        $merchant = auth()->user()->merchant;
        $merchant->update($request->except('document'));
        session()->flash('message', __('messages.success.updated'));

        return redirect()->back();
    }
}
