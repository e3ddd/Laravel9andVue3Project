<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AddProductController extends Controller
{
    public function index()
    {
        return view('AddProduct/layout');
    }


    public function store(AddProductRequest $request)
    {
        $user_id = User::where('email', $request->email)->first('id');
        Product::create([
                'user_id' => $user_id->id,
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
            ]);
    }
}
