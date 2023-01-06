<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegUserRequest;
use App\Models\Users;

class RegisterController extends Controller
{
    public function store(RegUserRequest $request)
    {
        Users::create([
            'email' => $request->email,
            'password' => $request->password,
         ]);
    }
}
