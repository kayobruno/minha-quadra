<?php

use App\Http\Controllers\Dash\Auth\AuthController;
use App\Http\Controllers\Dash\DashboardController;
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
});
