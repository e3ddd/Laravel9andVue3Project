<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegUserRequest;
use App\Repositories\UserRepository;
use App\Services\UserService;


class RegisterController extends Controller
{

    public function store(RegUserRequest $request)
    {
        $userService = new UserService(app(UserRepository::class));

        $userService->create($request->email, $request->password);
    }
}
