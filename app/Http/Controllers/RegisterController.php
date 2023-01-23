<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegUserRequest;
use App\Services\UserService;


class RegisterController extends Controller
{

    public function store(RegUserRequest $request)
    {
        $userService = app(UserService::class);

        $userService->create($request->email, $request->password);
    }
}
