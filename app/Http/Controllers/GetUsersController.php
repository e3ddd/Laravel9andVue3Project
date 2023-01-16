<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GetUsersController extends Controller
{
    public function get(Request $request, User $user)
    {

        if(!isset($request->search)){
            return $user::paginate(10);
        }else{
            return $user::where('email', 'like', $request->search . '%')->paginate(10);
        }
    }

}
