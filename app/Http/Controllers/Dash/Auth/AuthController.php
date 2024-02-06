<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dash\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dash\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('content.authentications.auth-login-basic');
    }

    public function processLogin(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (!Auth::attempt($credentials)) {
            return redirect()->back()->with('error', __('messages.errors.unauthorized'));
        }

        return redirect()->intended();
    }

    public function forgot()
    {
        return view('content.authentications.auth-forgot-password-basic');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}
