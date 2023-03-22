<?php

namespace App\Repositories\AdminPanel;

use App\Models\Category;

class CategoriesRepository
{
    public function getCategoryById($categoryId)
    {
        return Category::find($categoryId);
    }
    public function getCategoryByName($categoryName)
    {
        return Category::where('name', $categoryName)->get();
    }

    public function getAllCategories()
    {
        return Category::all();
    }

    public function getSubcategoriesByParentCategoryName($categoryName)
    {
        $categoryId = Category::where('name', $categoryName)->first()->id;
        return Category::where('parent_id', $categoryId)->get();
    }

    public function getAllCategoriesWithPagination()
    {
        return Category::with('attributes')->paginate(10);
    }
    public function createCategory($categoryName, $subcategoryName, $subCheck)
    {
        if($subCheck){
            Category::create([
                'name' => strtolower($subcategoryName),
                'parent_id' => Category::where('name', $categoryName)->first()->id
            ]);
        }else{
            if(Category::where('name', $categoryName)->doesntExist()){
                Category::create([
                    'name' => strtolower($categoryName),
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

    public function searchCategory($search)
    {
        return Category::where('name', 'like', '%' . $search . '%')->paginate(10);
    }
}
