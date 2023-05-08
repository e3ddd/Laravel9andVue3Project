<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserRepository
{
    /**
     * Get all users
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllUsers()
    {
        return User::all();
    }

    /**
     * Get user by id
     * @param integer|null $userId
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getUser($userId)
    {
        if($userId === null){
            throw new \RuntimeException('User id required');
        }
        return User::with('favoriteProducts')->find($userId);
    }

    /**
     * Get user by email
     * @param string|null $userEmail
     * @return mixed
     */
    public function getUserByEmail($userEmail)
    {
        if($userEmail === null){
            throw new \RuntimeException('User email required');
        }
        return User::where('email', $userEmail)->first();
    }

    /**
     * Get auth user with their shopping cart
     * @param integer|null $userId
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getAuthUserWithProductsInShoppingCart($userId)
    {
        if($userId === null){
            throw new \RuntimeException('User id required');
        }
        return User::with('productsInShoppingCart')->find($userId);
    }

    /**
     * Create and login user
     * @param string|null $userEmail
     * @param string|null $userPassword
     * @param string|null $userName
     * @param string|null $userSurname
     * @param string|null $userPhoneNumber
     * @return void
     */
    public function createUser($userEmail, $userPassword, $userName, $userSurname, $userPhoneNumber)
    {
        if($userEmail === null || $userPassword === null || $userName === null || $userSurname === null || $userPhoneNumber === null){
            throw new \RuntimeException('Every field required');
        }
        $user = User::create([
            'email' => $userEmail,
            'password' => Hash::make($userPassword),
            'name' => $userName,
            'surname' => $userSurname,
            'phone_number' => $userPhoneNumber
        ]);

       Auth::login($user);

       event(new Registered($user));
    }

    /**
     * Update user email
     * @param integer|null $userId
     * @param string|null $userEmail
     * @return mixed
     */
    public function updateUser($userId, $userEmail)
    {
        if($userEmail === null){
            throw new \RuntimeException('User email required');
        }

        if($userId === null){
            throw new \RuntimeException('User id required');
        }

        return User::find($userId)->update('email', $userEmail);
    }

    /**
     * Delete user from DB
     * @param integer|null $userId
     * @return int
     */
    public function destroyUser($userId)
    {
        if($userId === null){
            throw new \RuntimeException('User id required');
        }
        return User::destroy($userId);
    }

    /**
     * Search user
     * @param string|null $search
     * @return mixed
     */
    public function searchUser($search)
    {
        return User::where('email', 'like', $search . '%')->paginate(10);
    }
}
