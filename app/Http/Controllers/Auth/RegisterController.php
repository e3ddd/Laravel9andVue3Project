<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegUserRequest;
use App\Services\UserService;

class RegisterController extends Controller
{

    /**
     * Registration user
     * @param RegUserRequest $request
     * @return void
     */
    public function store(RegUserRequest $request)
    {
        /** @var UserService $userService */
        $userService = app(UserService::class);
        $userService->create($request->email, $request->password, $request->name, $request->surname, $request->phoneNumber, $request->confirm);
    }
}
