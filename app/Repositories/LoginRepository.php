<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;


class LoginRepository
{
    /**
     * Authentication user
     * @param string|null $userEmail
     * @param string|null $userPassword
     * @param string|null $remember
     * @return bool
     */
    public function authentication($userEmail, $userPassword, $remember)
    {
        if($userEmail === null){
            throw new \RuntimeException('E-mail required');
        }

        if($userPassword === null){
            throw new \RuntimeException('Password required');
        }

        $credentials  = [
           'email' => $userEmail,
           'password' => $userPassword,
        ];

       return Auth::attempt($credentials, $remember);
    }

}
