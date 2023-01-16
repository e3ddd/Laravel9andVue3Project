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


    public function store(AddProductRequest $request, Product $product, User $user)
    {
        $user_id = $user::where('email', $request->email)->get()[0]->id;
            $product::create([
                'user_id' => $user_id,
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
            ]);
    }
}
