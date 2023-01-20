<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegUserRequest;
use App\Models\User;
use App\Repositories\Service\UserService;

class RegisterController extends Controller
{
    private UserService $user;

    public function __construct(UserService $user)
    {
        $this->user = $user;
    }
    public function store(RegUserRequest $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $this->user->createUser($data);
    }
}
