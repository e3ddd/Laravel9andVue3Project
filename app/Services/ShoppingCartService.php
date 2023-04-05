<?php

namespace App\Services;

use App\Http\StripePaymentClass;
use App\Models\ShoppingCart;
use App\Repositories\AdminPanel\ProductRepository;
use App\Repositories\ShoppingCartRepository;
use App\Services\AdminPanel\ProductService;
use Illuminate\Support\Facades\Auth;

class ShoppingCartService
{
    private ShoppingCartRepository $shoppingCartRepository;
    private ProductRepository $productRepository;

    public function __construct(ShoppingCartRepository $shoppingCartRepository, ProductRepository $productRepository)
    {
        $this->shoppingCartRepository = $shoppingCartRepository;
        $this->productRepository = $productRepository;
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
        foreach (session()->pull('products') as $product){
            $this->deleteFromShoppingCart($product['product_id']);
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

    public function getUserShoppingCart()
    {
        if(Auth::check()){
            return $this->shoppingCartRepository->getUserShoppingCart();
        }else{
            return session()->get('products');
        }
    }

    public function checkout()
    {
        $shopping_cart = $this->shoppingCartRepository->getUserShoppingCart();
        $products = [];

        foreach ($shopping_cart as $item){
            session()->push('products', $item);
            $products[] = [
                [
                    'product' => $this->productRepository->getProductById($item['product_id']),
                    'quantity' => $item['quantity']
                ]
            ];
        }
        $stripe = new StripePaymentClass($products);

        return $stripe->createCheckoutSession();
    }
}
