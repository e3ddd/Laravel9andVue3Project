<?php

namespace App\Services;

use App\Http\StripePaymentClass;
use App\Models\ShoppingCart;
use App\Repositories\ShoppingCartRepository;
use Illuminate\Support\Facades\Auth;

class ShoppingCartService
{
    private ShoppingCartRepository $shoppingCartRepository;

    public function __construct(ShoppingCartRepository $shoppingCartRepository)
    {
        $this->shoppingCartRepository = $shoppingCartRepository;
    }

    /**
     * Store product by id ti shopping cart
     * @param integer|null $productId
     * @param integer|null $userId
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function storeToShoppingCart($productId, $userId)
    {
        $this->shoppingCartRepository->storeToShoppingCart($userId, $productId, 1);
    }

    /**
     * Get number of products in shopping cart by user id
     * @param integer|null $userId
     * @return mixed
     */
    public function getNumberOfProductsInShoppingCart($userId)
    {
        return $this->shoppingCartRepository->countProductsInShoppingCart($userId);
    }

    /**
     * Clear shopping cart
     * @return void
     */
    public function clearShoppingCart()
    {
        $shoppingCart = $this->getUserShoppingCart();
            foreach ($shoppingCart as $item){
                $this->deleteFromShoppingCart($item['product_id']);
            }
    }

    /**
     * Delete product by id from shopping cart
     * @param integer|null $shoppingCartProductId
     * @param integer|null $userId
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function deleteFromShoppingCart($shoppingCartProductId, $userId)
    {
        $this->shoppingCartRepository->deleteFromShoppingCart($shoppingCartProductId, $userId);
    }

    /**
     * Update product quantity
     * @param integer|null $productId
     * @param integer|null $quantity
     * @param integer|null $userId
     * @return void
     */
    public function updateProductQuantity($productId, $quantity, $userId)
    {
        $this->shoppingCartRepository->updateProductQuantity($userId, $productId, $quantity);
    }

    /**\
     * Get auth user shopping cart
     * @param integer|null $user_id
     * @return array
     */
    public function getUserShoppingCart($user_id = null)
    {
        if($user_id !== null){
            return $this->shoppingCartRepository->getUserShoppingCart($user_id);
        }

        return $this->shoppingCartRepository->getUserShoppingCart();

    }

    /**
     * Create Stripe checkout session
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string|null
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function checkout()
    {
        $checkout = new StripePaymentClass();
        $shoppingCartService = app(ShoppingCartService::class);

        $shoppingCart = $shoppingCartService->getUserShoppingCart();

        return $checkout->startCheckoutSession($checkout->createLineItems($shoppingCart)['products'], null);
    }
}
