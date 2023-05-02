<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\LoginService;

class LoginController extends Controller
{
    /**
     * Authentication user and login
     * @param LoginRequest $request
     * @return int
     */
    public function auth(LoginRequest $request)
    {
        /** @var LoginService $loginService */
        $loginService = app(LoginService::class);
        $loginService->auth($request->email, $request->password, $request->remember);
        return 1;
    }
}
