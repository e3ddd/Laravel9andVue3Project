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

    public function find($userId)
    {
        return $this->userRepository->getUser($userId);
    }

    public function create($userEmail, $userPassword, $userName, $userSurname, $userPhoneNumber, $confirm)
    {
        if($userPassword !== $confirm) {
            throw new \Exception('Password mismatch !');
        }

        $this->userRepository->createUser($userEmail, $userPassword, $userName, $userSurname, $userPhoneNumber,);

        $user = $this->userRepository->getUserByEmail($userEmail);

        if(session()->has('products')){
            foreach (session()->get('products') as $product){
                $this->shoppingCartRepository->storeToShoppingCart($user->id, $product[0]->product_id, $product[0]->quantity);
            }
            session()->forget('products');
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

