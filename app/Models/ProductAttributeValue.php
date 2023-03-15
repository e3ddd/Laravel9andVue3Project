<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeValue extends Model
{
    use HasFactory;

    protected $table = "products_attributes_values";

    protected $fillable = [
        'name',
        'value',
        'product_id'
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
