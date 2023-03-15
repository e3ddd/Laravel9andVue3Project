<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $table = 'products_attributes';
    protected $fillable = [
        'name',
        'value',
        'subcategory_id',
        'default'
    ];
}
