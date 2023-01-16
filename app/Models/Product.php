<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "users_products";
    protected $fillable =
        [
            'user_id',
            'name',
            'price',
            'description',
        ];

    public function image()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
