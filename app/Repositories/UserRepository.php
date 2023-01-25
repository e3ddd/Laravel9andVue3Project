<?php

namespace App\Repositories;

use App\Models\User;
use App\Providers\RouteServiceProvider;
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

    public function createUser($userEmail, $userPassword)
    {
        if(Auth::check()){
            return redirect(route('home'));
        }

       $user = User::create([
            'email' => $userEmail,
            'password' => Hash::make($userPassword)
        ]);

       if($user) {
           Auth::login($user);
           return redirect(route('home'));
       }
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
