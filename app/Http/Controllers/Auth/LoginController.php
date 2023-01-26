<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\LoginService;

class LoginController extends Controller
{
    public function auth(LoginRequest $request)
    {
        $loginService = app(LoginService::class);

        if($loginService->auth($request->email, $request->password)){
            $request->session()->regenerate();


            return redirect()->intended('home');
        }


    }
}
