<?php

namespace App\Services;

use App\Http\StripePaymentClass;
use App\Models\ShoppingCart;
use App\Models\User;
use App\Repositories\AdminPanel\ProductRepository;
use App\Repositories\ShoppingCartRepository;
use App\Services\AdminPanel\ProductService;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class ShoppingCartService
{
    private ShoppingCartRepository $shoppingCartRepository;

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
                    foreach (session()->get('products.' . $productId) as $product) {
                            $product->quantity += 1;
                            break;
                    }
            }else{
                $shoppingCartModel->user_id = null;
                $shoppingCartModel->product_id = $productId;
                $shoppingCartModel->quantity = 1;
                session()->put('products.' . $productId, $shoppingCartModel);
            }

        }
    }

    public function getNumberOfProductsInShoppingCart($userId)
    {
        return $this->shoppingCartRepository->countProductsInShoppingCart($userId);
    }

    public function clearShoppingCart()
    {
        $shoppingCart = $this->getUserShoppingCart();
            foreach ($shoppingCart as $item){
                $this->deleteFromShoppingCart($item['product_id']);
            }
    }

    public function deleteFromShoppingCart($shoppingCartProductId)
    {
        if(!Auth::check()){
            foreach (session()->get('products') as $key => $product){
                if($product->product_id == $shoppingCartProductId){
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
                if($productId == $product->product_id){
                    $product->quantity = $quantity;
                }
            }
        }
    }

    public function getUserShoppingCart($user_id = null)
    {
        if($user_id !== null){
            return $this->shoppingCartRepository->getUserShoppingCart($user_id);
        }

        if(Auth::check()){
            return $this->shoppingCartRepository->getUserShoppingCart();
        }else{
            return session()->get('products');
        }
    }

    public function checkout()
    {
        $checkout = new StripePaymentClass();
        return $checkout->createCheckoutSession();
    }
}
