<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class GetCategoriesController extends Controller
{
    public function get()
    {
        return Category::with('attributes')->paginate(10);
    }

    public function getSubcategoriesBuyCategoryId(Request $request)
    {
        $categoryId = Category::where('name', urldecode($request->category))->first()->id;

        return Category::where('parent_id', $categoryId)->get();
    }

    public function getAll()
    {
        return Category::with('attributes')->get();
    }

}
