<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
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
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function delete(string $id)
    {
        //
    }
}
