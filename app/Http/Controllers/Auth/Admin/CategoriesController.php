<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Services\AdminPanel\CategoriesService;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function showByCategory()
    {
        return view("ProductsList.bycategory");
    }

    public function showBySubcategory()
    {
        return view('ProductsList.bysubcategory');
    }

    public function getAllCategories()
    {
        $categoriesService = app(CategoriesService::class);
        return $categoriesService->getAllCategories();
    }

    public function getCategoryById(Request $request)
    {
        $categoriesService = app(CategoriesService::class);
        return $categoriesService->getCategoryById($request->category_id);
    }

    public function getAllCategoriesWithPagination()
    {
        $categoriesService = app(CategoriesService::class);
        return $categoriesService->getAllCategoriesWithPagination();
    }

    public function getSubcategoriesByParentCategoryName(Request $request)
    {
        $categoriesService = app(CategoriesService::class);
        return $categoriesService->getSubcategoriesByParentCategoryName($request->categoryName);
    }

    public function createCategory(CreateCategoryRequest $request)
    {
        $categoriesService = app(CategoriesService::class);
        $categoriesService->createCategory($request->categoryName, $request->subcategoryName, $request->subCheck);
    }

    public function editCategory(Request $request)
    {
        $categoriesService = app(CategoriesService::class);
        $categoriesService->editCategory($request->categoryId, $request->newCategoryName);
    }

    public function deleteCategory(Request $request)
    {
        $categoriesService = app(CategoriesService::class);
        $categoriesService->deleteCategory($request->categoryId);
    }

    public function searchCategory(Request $request)
    {
        $categoriesService = app(CategoriesService::class);
        return $categoriesService->searchCategory($request->search);
    }

}
