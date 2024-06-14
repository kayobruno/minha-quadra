<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dash;

use App\DataTransferObjects\ProductData;
use App\Enums\ProductType;
use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dash\Product\CreateRequest;
use App\Http\Requests\Dash\Product\UpdateRequest;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(private readonly ProductService $productService)
    {
    }

    public function index()
    {
        $products = $this->productService->paginate();

        return view('content.products.index', compact('products'));
    }

    public function create()
    {
        $statuses = Status::cases();
        $types = ProductType::cases();

        return view('content.products.create', compact('statuses', 'types'));
    }

    public function store(CreateRequest $request)
    {
        $productData = ProductData::fromRequest($request);
        $this->productService->save($productData);

        session()->flash('message', __('messages.success.created'));

        return redirect()->back();
    }

    public function edit(Product $product)
    {
        $statuses = Status::cases();
        $types = ProductType::cases();

        return view('content.products.edit', compact('product', 'statuses', 'types'));
    }

    public function update(UpdateRequest $request, Product $product)
    {
        $productData = ProductData::fromRequest($request);
        $this->productService->update($product->id, $productData);
        session()->flash('message', __('messages.success.updated'));

        return redirect()->back();
    }

    public function delete(Product $product)
    {
        $this->productService->delete($product->id);
        session()->flash('message', __('messages.success.removed'));

        return redirect()->back();
    }
}
