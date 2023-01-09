<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegUserRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function store(RegUserRequest $request, User $user)
    {
        $user::create([
            'email' => $request->email,
            'password' => $request->password,
         ]);
    }
}
