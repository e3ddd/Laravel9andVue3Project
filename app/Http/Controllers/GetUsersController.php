<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GetUsersController extends Controller
{
    public function get(Request $request)
    {

        if(!isset($request->search)){
            return User::paginate(10);
        }else{
            return User::where('email', 'like', $request->search . '%')->paginate(10);
        }
    }

}
