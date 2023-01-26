<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Services\ProductService;
use Illuminate\Support\Facades\Auth;

class Test extends Controller
{

    public function index()
    {
        dump(Auth::user()->id);
    }

}
