<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{

    public function get()
    {
        return new User;
    }
}
