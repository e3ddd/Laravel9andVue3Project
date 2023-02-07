<?php

namespace App\Http\Controllers;


use App\Http\Enums\DimensionsEnum;
use App\Http\Factories\ProductDimensionFactory;
use App\Mail\RegisterMail;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
use App\Notifications\RegisterNotification;
use Database\Factories\CategoryFactory;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class Test extends Controller
{

    public function show()
    {
        return view('testForm');
    }
    public function index(Request $request)
    {
         $res = [];
        if($request->dimensionType == "meters"){
            $dimension = new ProductDimensionFactory(DimensionsEnum::meter,
                                                         $request->dimensionValues);
            $res = $dimension->convert();
        }
        if($request->dimensionType == "millimeters"){
            $dimension = new ProductDimensionFactory(DimensionsEnum::millimeter,
                                                         $request->dimensionValues);
            $res = $dimension->convert();
        }
        if($request->dimensionType == "centimeters"){
            $res = $request->dimensionValues;
        }
        return $res;
    }

}

