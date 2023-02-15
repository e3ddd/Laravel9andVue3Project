<?php

namespace App\Http\Controllers;

use App\Http\Enums\MagnitudeEnums\WeightEnum;
use App\Http\Factories\Convert\DeterminantEnumValue;
use App\Models\Category;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;


class Test extends Controller
{

    public function show()
    {
        return view('testForm');
    }

    public function index(Request $request)
    {
        dump(ProductAttribute::where('subcategory_id', 21)
            ->where('name', 'Weight')
            ->exists());
    }
}

