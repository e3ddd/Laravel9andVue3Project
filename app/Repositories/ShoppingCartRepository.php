<?php

namespace App\Repositories;

use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;

class ShoppingCartRepository
{
    public function storeToShoppingCart($userid, $productId)
    {
            if(ShoppingCart::where('user_id', $userid)->where('product_id', $productId)->exists()){
                throw new \Exception('Product exist in your shopping cart !');
            }
            ShoppingCart::create([
                'user_id' => $userid,
                'product_id' => $productId
            ]);
    }

    public function deleteFromShoppingCart($shoppingCartProductId)
    {
        ShoppingCart::where('user_id', Auth::user()->getAuthIdentifier())->where('product_id', $shoppingCartProductId)->delete();
    }

    public function countProductsInShoppingCart($userId)
    {
        return count(ShoppingCart::where('user_id', $userId)->get()->toArray());
    }
}
