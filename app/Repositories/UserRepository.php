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

    public function createUser(string $email, string $password)
    {
        return User::create([
            'email' => $email,
            'password' => $password
        ]);
    }

    public function updateUser(int $userId, string $email)
    {
        return User::find($userId)->update('email', $email);
    }

    public function destroyUser(int $userId)
    {
        return User::destroy($userId);
    }

    public function searchUser(string $search)
    {
        return User::where('email', 'like', $search . '%')->paginate(10);
    }
}
