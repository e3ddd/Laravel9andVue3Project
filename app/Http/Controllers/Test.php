<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\User;
use App\Services\AdminPanel\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\String\s;


class Test extends Controller
{

    public function show()
    {
        return view('testForm');
    }

    public function index(Request $request)
    {
//        foreach (session()->get('products') as $product){
//            if($product[0]->contains(1)){
//                dump($product[0]->product_id);
//            }
//        }

//        dump(session()->all());

        $test = [];
        $shoppingCart = ShoppingCart::where('user_id', 8)->get(['product_id', 'quantity']);
        foreach ($shoppingCart as $item){
            $test[$item->product_id][0] = [
              'product_id' => $item->product_id,
              'quantity' => $item->quantity
            ];
        }
        dump($test);
    }
}

