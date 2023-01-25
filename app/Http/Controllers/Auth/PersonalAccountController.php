<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonalAccountController extends Controller
{
    public function show()
    {
        return view('PersonalAccount.layout');
    }
}
