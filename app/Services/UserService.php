<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function all()
    {
        return $this->userRepository->getAllUsers();
    }

    public function find($userId)
    {
        return $this->userRepository->getUser($userId);
    }

    public function create($userEmail, $userPassword)
    {
        return $this->userRepository->createUSer($userEmail, $userPassword);
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

