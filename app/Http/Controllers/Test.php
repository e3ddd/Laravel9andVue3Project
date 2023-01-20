<?php

namespace App\Http\Controllers;


use App\Service\UserService;


class Test extends Controller
{
    private UserService $user;

    public function __construct(UserService $user)
    {
        $this->user = $user;
    }
    public function index()
    {
        $this->user->createUser([
            'email' => 'example@gmail.com',
            'password' => '213sdadsa'
        ]);
    }

}
