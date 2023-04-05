<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    use HasFactory;

    use Billable;

    protected $table = 'users';
    protected $fillable = [
        'email',
        'password',
        'name',
        'surname',
        'phone_number'
    ];

    public function productsInShoppingCart()
    {
        return $this->hasMany(ShoppingCart::class, 'user_id');
    }
}
