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

    public function find(int $id)
    {
        return $this->userRepository->getUser($id);
    }

    public function create(string $email, string $password)
    {
        return $this->userRepository->createUSer($email, $password);
    }

    public function update(int $id, string $email)
    {
        return $this->userRepository->updateUser($id, $email);
    }

    public function destroy(int $id)
    {
        return $this->userRepository->destroyUser($id);
    }

    public function search(string $search)
    {
        return $this->userRepository->searchUser($search);
    }
}

