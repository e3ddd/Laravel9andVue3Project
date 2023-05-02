<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\LoginRepository;
use App\Repositories\ShoppingCartRepository;
use App\Repositories\UserRepository;
use function Symfony\Component\String\s;

class LoginService
{
    private LoginRepository $loginRepository;
    private ShoppingCartRepository $shoppingCartRepository;
    private UserRepository $userRepository;

    public function __construct(LoginRepository $loginRepository, ShoppingCartRepository $shoppingCartRepository, UserRepository $userRepository)
    {
        $this->loginRepository = $loginRepository;
        $this->shoppingCartRepository = $shoppingCartRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Authentication user and login
     * @param string|null $userEmail
     * @param string|null $userPassword
     * @param string|null $remember
     * @return void
     */
    public function auth($userEmail, $userPassword, $remember)
    {
        $user = $this->userRepository->getUserByEmail($userEmail);

        if($this->loginRepository->authentication($userEmail, $userPassword, $remember)){
            if(session()->has('products')){
                foreach (session()->pull('products') as $product){
                    $this->shoppingCartRepository->storeToShoppingCart($user->id, $product->product_id, $product->quantity);
                }
            }
            session()->regenerate();
        }
    }
}

