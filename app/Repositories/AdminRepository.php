<?php

namespace App\Repositories;

use App\Models\Category;

class AdminRepository
{
    public function createCategory($categoryName, $subcategoryName, $subCheck)
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

    public function editCategory($categoryId, $newCategoryName)
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
}
