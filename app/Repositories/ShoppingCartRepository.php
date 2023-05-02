<?php

namespace App\Repositories;

use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;

class ShoppingCartRepository
{
    /**
     * Store product to shopping cart
     * @param integer|null $userId
     * @param integer|null $productId
     * @param integer|null $quantity
     * @return void
     */
    public function storeToShoppingCart($userId, $productId, $quantity)
    {
        if($userId === null){
            throw new \RuntimeException('User id required');
        }

        if($productId === null){
            throw new \RuntimeException('Product id required');
        }

        if($quantity === null){
            throw new \RuntimeException('Quantity required');
        }
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

    /**
     * Delete product from shopping cart
     * @param integer|null $shoppingCartProductId
     * @param integer|null $userId
     * @return void
     */
    public function deleteFromShoppingCart($shoppingCartProductId, $userId)
    {
        if($userId === null){
            throw new \RuntimeException('User id required');
        }

        if($shoppingCartProductId === null){
            throw new \RuntimeException('Product id required');
        }

        ShoppingCart::where('user_id', $userId)->where('product_id', $shoppingCartProductId)->delete();
    }

    /**
     * Count products in shopping cart
     * @param integer|null $userId
     * @return mixed
     */
    public function countProductsInShoppingCart($userId)
    {
        if($userId === null){
            throw new \RuntimeException('User id required');
        }

        return ShoppingCart::where('user_id', $userId)->count();
    }

    /**
     * Update product quantity
     * @param integer|null $userId
     * @param integer|null $productId
     * @param integer|null $quantity
     * @return void
     */
    public function updateProductQuantity($userId, $productId, $quantity)
    {
        if($userId === null){
            throw new \RuntimeException('User id required');
        }

        if($productId === null){
            throw new \RuntimeException('Product id required');
        }

        ShoppingCart::where('user_id', $userId)->where('product_id', $productId)->update(['quantity' => $quantity]);
    }

    /**
     * Get user shopping cart
     * @param integer|null $userId
     * @return array
     */
    public function getUserShoppingCart($userId)
    {
        $responseShoppingCart = [];

        $shoppingCart = ShoppingCart::where('user_id', $userId)?->get(['product_id', 'quantity']);

        if($shoppingCart->isEmpty()){
            throw new \RuntimeException('User shopping cart not found');
        }

        foreach ($shoppingCart as $item){
            $responseShoppingCart[$item->product_id] = [
                'product_id' => $item->product_id,
                'quantity' => $item->quantity
            ];
        }
        return $responseShoppingCart;
    }

}

