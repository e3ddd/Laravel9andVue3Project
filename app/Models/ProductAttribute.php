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
        'dimension',
        'subcategory_id',
        'name_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }
}
