<?php

namespace App\Repositories\AdminPanel;

use App\Models\Category;
use App\Models\ProductAttribute;

class ProductRepository
{
    public function getAttributes($subcategory)
    {
        $subcategoryId = Category::where('name', $subcategory)->first()->id;

        return ProductAttribute::where('subcategory_id', $subcategoryId)->get();
    }
}
