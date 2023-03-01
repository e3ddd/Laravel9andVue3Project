<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSizeAttribute extends Model
{
    use HasFactory;

    protected $table = 'products_size_attributes';
    protected $fillable = [
        'name',
        'value',
        'subcategory_id',
    ];


}
