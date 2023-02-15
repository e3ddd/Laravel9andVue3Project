<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminPanelController extends Controller
{
    public function show()
    {
        return view('AdminPanel.layout');
    }

    public function createCategory(Request $request)
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
}
