<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable =
        [
            'name',
            'price',
            'producer',
            'description',
            'subcategory_id',
        ];

    /**
     * Product category relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    /**
     * Product images relation
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function image()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    /**
     * Product attributes relation
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attribute()
    {
        return $this->hasMany(ProductAttributeValue::class, 'product_id');
    }


    /**
     * Products in favorites relation
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorite()
    {
        return $this->hasMany(FavoriteProduct::class, 'product_id');
    }
}
