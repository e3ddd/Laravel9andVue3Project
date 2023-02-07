<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class GetCategoriesController extends Controller
{
    public function get()
    {
        return Category::with('subcategory')->get();
    }

    public function getSub(Request $request)
    {
        $categoryId = Category::where('name', $request->category)->first()->toArray()['id'];

        return Subcategory::where('category_id', $categoryId)->get();
    }
}
