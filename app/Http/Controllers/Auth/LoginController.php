<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use Illuminate\Auth\Events\Verified;

class LoginController extends Controller
{
    public function auth(LoginRequest $request)
    {
        $loginService = app(LoginService::class);
        $loginService->auth($request->email, $request->password, $request->remember);
        return 1;
    }
}
