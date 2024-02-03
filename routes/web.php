<?php

use App\Http\Controllers\Dash\Auth\AuthController;
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

Route::get('/', function () {
    return view('content.dashboard.dashboards-analytics');
});

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('forgot-password', [AuthController::class, 'forgot'])->name('forgot');
