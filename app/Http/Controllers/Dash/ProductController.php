<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);

        return view('content.products.index', compact('products'));
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function edit(Product $product)
    {

    }

    public function update(Product $product)
    {

    }

    public function delete(Product $product)
    {

    }
}
