<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\CustomerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::get('bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');

Route::get('customers', [CustomerController::class, 'findByName'])->name('customers.find');
