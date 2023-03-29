<?php

namespace App\Services;

use App\Models\ShoppingCart;
use App\Repositories\ShoppingCartRepository;
use Illuminate\Support\Facades\Auth;

class ShoppingCartService
{
    public ShoppingCartRepository $shoppingCartRepository;

    public function __construct(ShoppingCartRepository $shoppingCartRepository)
    {
        $this->shoppingCartRepository = $shoppingCartRepository;
    }

    public function storeToShoppingCart($productId)
    {
        if(Auth::check()){
            $userId = Auth::user()->id;
            $this->shoppingCartRepository->storeToShoppingCart($userId, $productId, 1);
        }else{
            $shoppingCartModel = new ShoppingCart();
            if(session()->has('products.' . $productId)){
                    foreach (session()->get('products.' . $productId) as $key => $product) {
                            $product->quantity += 1;
                            break;
                    }
            }else{
                $shoppingCartModel->user_id = null;
                $shoppingCartModel->product_id = $productId;
                $shoppingCartModel->quantity = 1;
                session()->push('products.' . $productId, $shoppingCartModel);
            }

        }
    }

    public function getNumberOfProductsInShoppingCart($userId)
    {
        return $this->shoppingCartRepository->countProductsInShoppingCart($userId);
    }

    public function deleteFromShoppingCart($shoppingCartProductId)
    {
        if(!Auth::check()){
            foreach (session()->get('products') as $key => $product){
                if($product[0]->product_id == $shoppingCartProductId){
                    session()->forget('products.' . $shoppingCartProductId);
                }
            }
        }else{
            $this->shoppingCartRepository->deleteFromShoppingCart($shoppingCartProductId);
        }
    }

    public function updateProductQuantity($productId, $quantity)
    {
        if(Auth::check()){
            $this->shoppingCartRepository->updateProductQuantity(Auth::user()->id, $productId, $quantity);
        }else{
            foreach (session()->get('products') as $product) {
                if($productId == $product[0]->product_id){
                    $product[0]->quantity = $quantity;
                }
            }
        }
    }

    public function getUserShoppingCart()
    {
        if(Auth::check()){
            return $this->shoppingCartRepository->getUserShoppingCart();
        }else{
            return session()->get('products');
        }
    }
}
