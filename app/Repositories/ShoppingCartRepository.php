<?php

namespace App\Repositories;

use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;

class ShoppingCartRepository
{
    public function storeToShoppingCart($userId, $productId, $quantity)
    {
            if(ShoppingCart::where('user_id', $userId)->where('product_id', $productId)->exists()){
                $currQuantity = ShoppingCart::where('user_id', $userId)->where('product_id', $productId)->first()->quantity + 1;
                $this->updateProductQuantity($userId, $productId, $currQuantity);
            }else{
                ShoppingCart::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'quantity' => $quantity
                ]);
            }
    }

    public function deleteFromShoppingCart($shoppingCartProductId)
    {
        ShoppingCart::where('user_id', Auth::user()->id)->where('product_id', $shoppingCartProductId)->delete();
    }

    public function countProductsInShoppingCart($userId)
    {
        return ShoppingCart::where('user_id', $userId)->count();
    }

    public function updateProductQuantity($userId, $productId, $quantity)
    {
        ShoppingCart::where('user_id', $userId)->where('product_id', $productId)->update(['quantity' => $quantity]);
    }

    public function getUserShoppingCart()
    {
        $responseShoppingCart = [];
        $shoppingCart = ShoppingCart::where('user_id', Auth::user()->id)->get(['product_id', 'quantity']);

        foreach ($shoppingCart as $item){
            $responseShoppingCart[$item->product_id][0] = [
                'product_id' => $item->product_id,
                'quantity' => $item->quantity
            ];
        }

        return $responseShoppingCart;

    }
}

