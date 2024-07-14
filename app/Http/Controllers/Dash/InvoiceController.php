<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dash;

use App\Enums\InvoiceType;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('content.invoices.index');
    }

    public function create()
    {
        $types = InvoiceType::cases();

        return view('content.invoices.create', compact('types'));
    }
}
