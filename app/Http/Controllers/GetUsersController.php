<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class GetUsersController extends Controller
{
    public function get(Request $request)
    {

        $userService = app(UserService::class);
        if(!isset($request->search)){
            return User::paginate(10);
        }else{
            return $userService->search($request->search);
        }
    }

}
