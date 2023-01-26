<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegUserRequest;
use App\Mail\RegisterMail;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class RegisterController extends Controller
{

    public function store(RegUserRequest $request)
    {
        $userService = app(UserService::class);

        $userService->create($request->email, $request->password);

    }
}
