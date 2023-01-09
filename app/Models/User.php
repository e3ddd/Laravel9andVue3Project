<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
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
