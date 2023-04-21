<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('AdminPanel/layout');
    }

    public function get()
    {
        return Auth::user();
    }

    public function edit(EditUserRequest $request)
    {
        $userService = app(UserService::class);

        $userService->update($request->id, $request->email);
    }

    public function destroy(Request $request)
    {
        $userService = app(UserService::class);

        $userService->destroy($request->id);
    }

}
