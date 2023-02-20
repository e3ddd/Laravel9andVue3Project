<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAttributeRequest;
use App\Http\Requests\CreateCategoryRequest;
use App\Services\AdminPanel\CategoriesAndAttributesService;
use Illuminate\Http\Request;

class CategoriesAndAttributesController extends Controller
{
    public function show()
    {
        return view('AdminPanel.CategoriesAndAttributes.layout');
    }

    public function createCategory(CreateCategoryRequest $request)
    {
        $categoriesAndAttributesRepositoryService = app(CategoriesAndAttributesService::class);
        $categoriesAndAttributesRepositoryService->createCategory($request->categoryName, $request->subcategoryName, $request->subCheck);
    }

    public function editCategory(Request $request)
    {
        $categoriesAndAttributesRepositoryService = app(CategoriesAndAttributesService::class);
        $categoriesAndAttributesRepositoryService->editCategory($request->categoryId, $request->newCategoryName);
    }

    public function deleteCategory(Request $request)
    {
        $categoriesAndAttributesRepositoryService = app(CategoriesAndAttributesService::class);
        $categoriesAndAttributesRepositoryService->deleteCategory($request->categoryId);
    }

    public function searchCategory(Request $request)
    {
        $categoriesAndAttributesRepositoryService = app(CategoriesAndAttributesService::class);
        return $categoriesAndAttributesRepositoryService->searchCategory($request->search);
    }

    public function createAttribute(CreateAttributeRequest $request)
    {
        $categoriesAndAttributesRepositoryService = app(CategoriesAndAttributesService::class);
        $categoriesAndAttributesRepositoryService->createAttribute($request->subcategoryName, $request->attrName, $request->attrValue);
    }
}
