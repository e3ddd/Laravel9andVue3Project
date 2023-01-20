<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegUserRequest;
use App\Service\UserService;


class RegisterController extends Controller
{

    public function store(RegUserRequest $request)
    {
        $userService = new UserService();

        $userService->create($request->email, $request->password);
    }
}
