<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dash;

use App\Enums\ProductType;
use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dash\Product\CreateRequest;
use App\Models\Product;
use App\Services\UploadService;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);

        return view('content.products.index', compact('products'));
    }

    public function create()
    {
        $statuses = Status::cases();
        $types = ProductType::cases();

        return view('content.products.create', compact('statuses', 'types'));
    }

    public function store(CreateRequest $request, UploadService $uploadService)
    {
        $data = $request->all();
        $merchantId = auth()->user()->merchant_id;
        $data['merchant_id'] = $merchantId;
        $data['image'] = $uploadService->upload(request: $request, path: "products/{$merchantId}", fileField: 'image');

        Product::create($data);

        session()->flash('message', __('messages.success.created'));

        return redirect()->back();
    }

    public function edit(Product $product)
    {

    }

    public function update(Product $product)
    {

    }

    public function delete(Product $product)
    {
        $product->delete();
        session()->flash('message', __('messages.success.removed'));

        return redirect()->back();
    }
}
