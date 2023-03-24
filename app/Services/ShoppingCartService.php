<?php

namespace App\Services;

use App\Repositories\ShoppingCartRepository;
use Exception;
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
            $userId = Auth::user()->getAuthIdentifier();
            if(session()->has('productIds')){
                foreach (session()->get('productIds') as $prodId){
                    $this->shoppingCartRepository->storeToShoppingCart($userId, $prodId);
                }
                session()->forget('productIds');
            }
            $this->shoppingCartRepository->storeToShoppingCart($userId, $productId);
        }else{
            if(session()->has('productIds')){
                foreach (session()->get('productIds') as $prodId){
                    if($prodId == $productId){
                        throw new Exception('Product exist in your shopping cart !');
                    }
                }
            }
            session()->push('productIds', $productId);
        }
    }

    public function getNumberOfProductsInShoppingCart($userId)
    {
            return $this->shoppingCartRepository->countProductsInShoppingCart($userId);
    }

    public function deleteFromShoppingCart($shoppingCartProductId)
    {
        if(!Auth::check()){

            $newSession = array_filter(session()->get('productIds'), function($item) use ($shoppingCartProductId) {
                return $item === $shoppingCartProductId;
            });

            session()->forget('productIds');
            session()->put($newSession);
        }else{
            $this->shoppingCartRepository->deleteFromShoppingCart($shoppingCartProductId);
        }
    }
}
