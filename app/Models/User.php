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

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
