<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class GetUsersController extends Controller
{
    public function get(Request $request, Users $users)
    {
        if(isset($request->toEdit)){
            return $users::where('id', $request->toEdit);
        }
        if(!isset($request->search)){
            return $users::paginate(10);
        }else{
            return $users::where('email', 'like', $request->search . '%')->paginate(10);
        }
    }

}
