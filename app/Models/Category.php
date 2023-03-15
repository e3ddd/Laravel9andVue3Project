<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $fillable = [
        'name',
        'parent_id'
    ];


    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'subcategory_id');

    }
}

