<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\ProductAttribute;

class AdminRepository
{
    public function createCategory(string $categoryName, string $subcategoryName, bool $subCheck)
    {
       if($subCheck){
               Category::create([
                   'name' => $subcategoryName,
                   'parent_id' => Category::where('name', $categoryName)->first()->toArray()['id']
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

    public function createAttribute($subcategory, $attrName, $attrValue)
    {
        $subcategoryId = Category::where('name', $subcategory)->first()->toArray()['id'];

        if(ProductAttribute::where('subcategory_id', $subcategoryId)
            ->where('name', $attrName)
            ->exists()){
            throw new \Exception('This attribute already exist !');
        }

        ProductAttribute::create([
            'subcategory_id' => $subcategoryId,
            'name' => $attrName,
            'dimension' => $attrValue
        ]);
    }
}
