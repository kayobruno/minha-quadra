<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dash;

use App\DataTransferObjects\MerchantData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dash\Merchant\UpdateRequest;
use App\Services\MerchantService;

class MyMerchantController extends Controller
{
    public function edit()
    {
        $merchant = auth()->user()->merchant;

        return view('content.merchants.edit', compact('merchant'));
    }

    public function update(UpdateRequest $request, MerchantService $merchantService)
    {
        $merchantData = MerchantData::fromRequest($request);
        $merchantService->update(auth()->user()->merchant_id, $merchantData);
        session()->flash('message', __('messages.success.updated'));

        return redirect()->back();
    }
}
