<?php

namespace App\Services;

use App\Repositories\LoginRepository;
use Illuminate\Support\Facades\Session;

class LoginService
{
    private LoginRepository $loginRepository;

    public function __construct(LoginRepository $loginRepository)
    {
        $this->loginRepository = $loginRepository;
    }

    public function auth($userEmail, $userPassword)
    {
        Session::flush();
        if($this->loginRepository->authentication($userEmail, $userPassword)){
               return true;
        }
    }

}

