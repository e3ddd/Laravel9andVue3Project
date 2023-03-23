<?php

namespace App\Repositories;

use App\Models\User;
use App\Notifications\RegisterNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserRepository
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function getUser($userId)
    {
        return User::find($userId);
    }

    public function getAuthUserWithProductsInShoppingCart()
    {
        return User::with('productsInShoppingCart')->find(Auth::user()->getAuthIdentifier());
    }

    public function createUser($userEmail, $userPassword)
    {
       $user = User::create([
            'email' => $userEmail,
            'password' => Hash::make($userPassword)
        ]);

       Auth::login($user);

        event(new Registered($user));
    }

    public function updateUser($userId, $userEmail)
    {
        return User::find($userId)->update('email', $userEmail);
    }

    public function destroyUser($userId)
    {
        return User::destroy($userId);
    }

    public function searchUser($search)
    {
        return User::where('email', 'like', $search . '%')->paginate(10);
    }
}
