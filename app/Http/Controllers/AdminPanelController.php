<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAttributeRequest;
use App\Http\Requests\CreateCategoryRequest;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminPanelController extends Controller
{
    public function show()
    {
        return view('AdminPanel.layout');
    }

    public function createCategory(CreateCategoryRequest $request)
    {
        $adminService = app(AdminService::class);
        $adminService->createCategory($request->categoryName, $request->subcategoryName, $request->subCheck);
    }

    public function editCategory(Request $request)
    {
        $adminService = app(AdminService::class);
        $adminService->editCategory($request->categoryId, $request->newCategoryName);
    }

    public function deleteCategory(Request $request)
    {
        $adminService = app(AdminService::class);
        $adminService->deleteCategory($request->categoryId);
    }

    public function searchCategory(Request $request)
    {
        $adminService = app(AdminService::class);
        return $adminService->searchCategory($request->search);
    }

    public function createAttribute(CreateAttributeRequest $request)
    {
        $adminService = app(AdminService::class);
        $adminService->createAttribute($request->subcategoryName, $request->attrName, $request->attrValue);
    }
}
