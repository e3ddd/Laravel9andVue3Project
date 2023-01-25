<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;


class LoginRepository
{
   public function authentication($userEmail, $userPassword)
   {

       $credentials  = [
           'email' => $userEmail,
           'password' => $userPassword,
       ];

       return Auth::attempt($credentials);
   }

}
