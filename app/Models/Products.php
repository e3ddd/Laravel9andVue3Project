<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = "user_product";
    protected $fillable =
        [
            'email',
            'name',
            'price',
            'description',
        ];
}
