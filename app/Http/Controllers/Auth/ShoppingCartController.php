<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ShoppingCart;
use App\Services\AdminPanel\OrderService;
use App\Services\ShoppingCartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ShoppingCartController extends Controller
{
    /**
     * Show shopping cart page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show()
    {
        return view('ShoppingCart.layout');
    }

    /**
     * Store products by id to shopping cart
     * @param Request $request
     * @return void
     */
    public function storeToShoppingCart(Request $request)
    {
        if(Auth::check()){
            /** @var ShoppingCartService $shoppingCartService */
            $shoppingCartService = app(ShoppingCartService::class);
            $shoppingCartService->storeToShoppingCart($request->productId, Auth::user()->id);
        }else{
            $shoppingCartModel = new ShoppingCart();
            if(session()->has('products.' . $request->productId)){
                foreach (session()->get('products.' . $request->productId) as $product) {
                    $product->quantity += 1;
                    break;
                }
            }else{
                $shoppingCartModel->user_id = null;
                $shoppingCartModel->product_id = $request->productId;
                $shoppingCartModel->quantity = 1;
                session()->put('products.' . $request->productId, $shoppingCartModel);
            }

        }
    }

    /**
     * Get number of products in shopping cart
     * @return int|void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getNumberOfProductsInShoppingCart()
    {
        if(Auth::check()){
            /** @var ShoppingCartService $shoppingCartService */
            $shoppingCartService = app(ShoppingCartService::class);
            return $shoppingCartService->getNumberOfProductsInShoppingCart(Auth::user()->id);
        }else{
            if(session()->has('products')){
                return count(session()->get('products'));
            }
        }
    }

    /**
     * Clear shopping cart
     * @return void
     */
    public function clearShoppingCart()
    {
        /** @var ShoppingCartService $shoppingCartService */
        $shoppingCartService = app(ShoppingCartService::class);
        $shoppingCartService->clearShoppingCart();
    }

    /**
     * Delete from shopping cart by product id
     * @param Request $request
     * @return mixed
     */
    public function deleteFromShoppingCart(Request $request)
    {
        if(!Auth::check()){
            foreach (session()->get('products') as $key => $product){
                if($product->product_id == $request->shoppingCartProductId){
                    session()->forget('products.' . $request->shoppingCartProductId);
                }
            }
        }else {
            /** @var ShoppingCartService $shoppingCartService */
            $shoppingCartService = app(ShoppingCartService::class);
            $shoppingCartService->deleteFromShoppingCart($request->shoppingCartProductId, Auth::user()->id);
        }
    }

    /**
     * Update product quantity
     * @param Request $request
     * @return mixed
     */
    public function updateProductQuantity(Request $request)
    {
        if(Auth::check()){
            /** @var ShoppingCartService $shoppingCartService */
            $shoppingCartService = app(ShoppingCartService::class);
            $shoppingCartService->updateProductQuantity($request->productId, $request->quantity, Auth::user()->id);
        }else{
            foreach (session()->get('products') as $product) {
                if($request->productId == $product->product_id){
                    $product->quantity = $request->quantity;
                }
            }
        }

    }

    /**
     * Get auth user shopping cart
     * @return mixed
     */
    public function getUserShoppingCart()
    {
        if(Auth::check()){
            /** @var ShoppingCartService $shoppingCartService */
            $shoppingCartService = app(ShoppingCartService::class);
            return $shoppingCartService->getUserShoppingCart();
        }else{
            return session()->get('products');
        }
    }

}
