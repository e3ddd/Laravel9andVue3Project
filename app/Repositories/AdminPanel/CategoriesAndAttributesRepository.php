<?php

namespace App\Repositories\AdminPanel;

use App\Models\Category;
use App\Models\ProductAttribute;

class CategoriesAndAttributesRepository
{
    public function createCategory(string $categoryName, string|null $subcategoryName, bool|null $subCheck)
    {
       if($subCheck){
               Category::create([
                   'name' => $subcategoryName,
                   'parent_id' => Category::where('name', $categoryName)->first()->id
               ]);
       }else{
           if(Category::where('name', $categoryName)->doesntExist()){
               Category::create([
                   'name' => $categoryName,
                   'parent_id' => null
               ]);
           }
       }
    }

    public function editCategory(int $categoryId, string $newCategoryName)
    {
        return Category::find($categoryId)->update(['name' => $newCategoryName]);
    }

    public function deleteCategory($categoryId)
    {
        if(!empty(Category::find($categoryId)->toArray()['parent_id'])){
            Category::destroy($categoryId);
        }else{
            array_map(function($item) use ($categoryId) {
                if($item['parent_id'] == $categoryId){
                    throw new \Exception('This category has subcategories !');
                }
            }, Category::all()->toArray());
            Category::destroy($categoryId);
        }
    }

    public function searchCategory($search)
    {
        return Category::where('name', 'like', $search . '%')->paginate(10);
    }

    public function createAttribute($subcategoryId, $attrName, $attrValue, $default)
    {
        if(ProductAttribute::where('subcategory_id', $subcategoryId)
            ->where('name', $attrName)
            ->where('default', 0)
            ->exists()){
            throw new \Exception('This attribute already exist !');
        }
        if(ProductAttribute::where('subcategory_id', $subcategoryId)
            ->where('name', $attrName)
            ->where('default', 1)
            ->exists()){
            return 0;
        }

        ProductAttribute::create([
            'subcategory_id' => $subcategoryId,
            'name' => $attrName,
            'value' => $attrValue,
            'default' => $default,
        ]);
    }
}
