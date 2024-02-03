<?php

namespace App\Http\Controllers\Dash\Auth;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return view('content.authentications.auth-login-basic');
    }
}
