<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class GetCategoriesController extends Controller
{
    public function get()
    {
        return Category::all();
    }
}
