<?php

namespace App\Http\Controllers\Dash\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dash\Auth\LoginRequest;

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

        return redirect()->intended('dashboard.index');
    }

    public function forgot()
    {
        return view('content.authentications.auth-forgot-password-basic');
    }
}
