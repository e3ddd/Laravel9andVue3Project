<?php

namespace App\Repositories;

use App\Models\User;

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
        return User::create([
            'email' => $userEmail,
            'password' => $userPassword
        ]);
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
