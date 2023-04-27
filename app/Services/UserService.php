<?php

namespace App\Services;

use App\Repositories\ShoppingCartRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserService
{
    private UserRepository $userRepository;
    private ShoppingCartRepository $shoppingCartRepository;

    public function __construct(UserRepository $userRepository, ShoppingCartRepository $shoppingCartRepository)
    {
        $this->userRepository = $userRepository;
        $this->shoppingCartRepository = $shoppingCartRepository;
    }

    public function all()
    {
        return $this->userRepository->getAllUsers();
    }

    public function getUser($userId)
    {
        return $this->userRepository->getUser($userId);
    }

    public function create($userEmail, $userPassword, $userName, $userSurname, $userPhoneNumber, $confirm)
    {
        if($userPassword !== $confirm) {
            throw new \Exception('Password mismatch !');
        }


        if(is_string($userEmail) && is_string($userPassword) && is_string($userName) && is_string($userSurname) && strlen($userPhoneNumber) === 13){
            try {
                $this->userRepository->createUser($userEmail, $userPassword, $userName, $userSurname, $userPhoneNumber);
            }catch (\Exception $e){
                return response($e, 500);
            }
        }

        $user = $this->userRepository->getUserByEmail($userEmail);

        if(session()->has('products')){
            foreach (session()->pull('products') as $product){
                $this->shoppingCartRepository->storeToShoppingCart($user->id, $product->product_id, $product->quantity);
            }
        }

    }

    public function update($userId, $userEmail)
    {
        return $this->userRepository->updateUser($userId, $userEmail);
    }

    public function destroy($userId)
    {
        return $this->userRepository->destroyUser($userId);
    }

    public function search(string $search)
    {
        return $this->userRepository->searchUser($search);
    }
}

