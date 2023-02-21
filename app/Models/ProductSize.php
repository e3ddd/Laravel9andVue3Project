<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    protected $table = 'product_size';
    protected $fillable = [
        'long',
        'width',
        'height',
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
