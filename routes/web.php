<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dash\ProductController;
use App\Http\Controllers\Dash\CustomerController;
use App\Http\Controllers\Dash\Auth\AuthController;
use App\Http\Controllers\Dash\DashboardController;

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
    Route::get('products/{customer}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{customer}/update', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{customer}', [ProductController::class, 'delete'])->name('products.delete');
});
