<?php

use App\Http\Controllers\Dash\Auth\AuthController;
use App\Http\Controllers\Dash\BookingController;
use App\Http\Controllers\Dash\CourtController;
use App\Http\Controllers\Dash\CustomerController;
use App\Http\Controllers\Dash\DashboardController;
use App\Http\Controllers\Dash\MyMerchantController;
use App\Http\Controllers\Dash\OrderController;
use App\Http\Controllers\Dash\ProductController;
use App\Http\Controllers\Dash\SupplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'processLogin'])->name('login.process');
Route::get('forgot-password', [AuthController::class, 'forgot'])->name('forgot')->middleware('guest');

Route::namespace('Admin')->middleware('auth:web')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('customers/store', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('customers/{customer}', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('customers/{customer}/update', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('customers/{customer}', [CustomerController::class, 'delete'])->name('customers.delete');

    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{product}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{product}/update', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [ProductController::class, 'delete'])->name('products.delete');

    Route::get('suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('suppliers/store', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('suppliers/{supplier}', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::put('suppliers/{supplier}/update', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('suppliers/{supplier}', [SupplierController::class, 'delete'])->name('suppliers.delete');

    Route::get('courts', [CourtController::class, 'index'])->name('courts.index');
    Route::get('courts/create', [CourtController::class, 'create'])->name('courts.create');
    Route::post('courts/store', [CourtController::class, 'store'])->name('courts.store');
    Route::get('courts/{court}', [CourtController::class, 'edit'])->name('courts.edit');
    Route::put('courts/{court}/update', [CourtController::class, 'update'])->name('courts.update');
    Route::delete('courts/{court}', [CourtController::class, 'delete'])->name('courts.delete');

    Route::get('my-merchant', [MyMerchantController::class, 'edit'])->name('mymerchant.edit');
    Route::put('my-merchant/update', [MyMerchantController::class, 'update'])->name('mymerchant.update');

    Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('bookings/store', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('bookings/{booking}', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('bookings/{booking}/update', [BookingController::class, 'update'])->name('bookings.update');

    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
});
