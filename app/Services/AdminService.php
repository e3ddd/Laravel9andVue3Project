<?php

namespace App\Services;

use App\Repositories\AdminRepository;

class AdminService
{
    private AdminRepository $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function createCategory($categoryName, $subcategoryName, $subCheck): void
    {
        $this->adminRepository->createCategory($categoryName, $subcategoryName, $subCheck);
    }

    public function editCategory($categoryId, $newCategoryName)
    {
        return $this->adminRepository->editCategory($categoryId, $newCategoryName);
    }

    public function deleteCategory($categoryId)
    {
        $this->adminRepository->deleteCategory($categoryId);
    }
}
