<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    use HasFactory;

    protected $table = 'users';
    protected $fillable = [
        'email',
        'password',
    ];

    public function productsInShoppingCart()
    {
        return $this->hasMany(ShoppingCart::class, 'user_id');
    }
}
