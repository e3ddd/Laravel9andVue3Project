<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class Test extends Controller
{

    public function show()
    {
        return view('testForm');
    }

    public function index(Request $request)
    {
        dd(Category::paginate(10));
    }
}

