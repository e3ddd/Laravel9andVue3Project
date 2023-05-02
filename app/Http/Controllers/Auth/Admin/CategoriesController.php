<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Services\AdminPanel\CategoriesService;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Show category list
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showByCategory()
    {
        return view("ProductsList.bycategory");
    }

    /**
     * Show subcategory list
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showBySubcategory()
    {
        return view('ProductsList.bysubcategory');
    }

    /**
     * Get all categories
     * @return mixed
     */
    public function getAllCategories()
    {
        /** @var CategoriesService $categoriesService */
        $categoriesService = app(CategoriesService::class);
        return $categoriesService->getAllCategories();
    }

    /**
     * Get category by id
     * @param Request $request
     * @return mixed
     */
    public function getCategoryById(Request $request)
    {
        /** @var CategoriesService $categoriesService */
        $categoriesService = app(CategoriesService::class);
        return $categoriesService->getCategoryById($request->category_id);
    }

    /**
     * Get all categories with pagination
     * @return mixed
     */
    public function getAllCategoriesWithPagination()
    {
        /** @var CategoriesService $categoriesService */
        $categoriesService = app(CategoriesService::class);
        return $categoriesService->getAllCategoriesWithPagination();
    }

    /**
     * Get subcategories by parent category name
     * @param Request $request
     * @return mixed
     */
    public function getSubcategoriesByParentCategoryName(Request $request)
    {
        /** @var CategoriesService $categoriesService */
        $categoriesService = app(CategoriesService::class);
        return $categoriesService->getSubcategoriesByParentCategoryName($request->categoryName);
    }

    /**
     * Create category
     * @param CreateCategoryRequest $request
     * @return void
     */
    public function createCategory(CreateCategoryRequest $request)
    {
        /** @var CategoriesService $categoriesService */
        $categoriesService = app(CategoriesService::class);
        $categoriesService->createCategory($request->categoryName, $request->subcategoryName, $request->subCheck);
    }

    /**
     * Edit category
     * @param Request $request
     * @return void
     */
    public function editCategory(Request $request)
    {
        /** @var CategoriesService $categoriesService */
        $categoriesService = app(CategoriesService::class);
        $categoriesService->editCategory($request->categoryId, $request->newCategoryName);
    }

    /**
     * Delete category by category id
     * @param Request $request
     * @return void
     */
    public function deleteCategory(Request $request)
    {
        /** @var CategoriesService $categoriesService */
        $categoriesService = app(CategoriesService::class);
        $categoriesService->deleteCategory($request->categoryId);
    }

    /**
     * Search category by category name
     * @param Request $request
     * @return mixed
     */
    public function searchCategory(Request $request)
    {
        /** @var CategoriesService $categoriesService */
        $categoriesService = app(CategoriesService::class);
        return $categoriesService->searchCategory($request->search);
    }

}
