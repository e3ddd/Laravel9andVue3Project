<?php

namespace App\Http\Controllers;

use App\Models\Category;

class GetCategoriesController extends Controller
{
    public function get()
    {
        return Category::paginate(10);
    }

}
