<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use function Illuminate\Events\queueable;
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
        'phone_number',
    ];

    /**
     * Auth user prodcuts in shopping cart relation
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productsInShoppingCart()
    {
        return $this->hasMany(ShoppingCart::class, 'user_id');
    }

    /**
     * Auth user favorites products relation
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favoriteProducts()
    {
        return $this->hasMany(FavoriteProduct::class, 'user_id');
    }

    public function userOrders()
    {

    }
}
