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
        $product = [];
        $return_value = '';
        foreach ($request->dimensionValues as $key => $value){
            $type = match ($key){
                'width', 'height', 'long' => $value,
            };
            switch ($request->dimensionType) {
                case 'millimeters':
                    $convert = new ProductDimensionFactory(DimensionsEnum::millimeter, $type);
                    $return_value = $convert->convertToMillimeter();
                    break;
                case 'centimeters':
                    $convert = new ProductDimensionFactory(DimensionsEnum::centimeter, $type);
                    $return_value = $convert->convertToMillimeter();
                    break;
                case 'meters':
                    $convert = new ProductDimensionFactory(DimensionsEnum::meter, $type);
                    $return_value = $convert->convertToMillimeter();
                    break;
            }

            $product[] = $return_value;
        }
        return $product;
    }

}

