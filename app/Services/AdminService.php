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

    public function createCategory(string $categoryName, string $subcategoryName, bool $subCheck): void
    {
        $this->adminRepository->createCategory($categoryName, $subcategoryName, $subCheck);
    }

    public function editCategory(int $categoryId, string $newCategoryName)
    {
        return $this->adminRepository->editCategory($categoryId, $newCategoryName);
    }

    public function deleteCategory(int $categoryId)
    {
        $this->adminRepository->deleteCategory($categoryId);
    }

    public function searchCategory($search)
    {
        return $this->adminRepository->searchCategory($search);
    }

    public function createAttribute($subcategory, $attrName, $attrValue)
    {
        $attrName = strtolower($attrName);
        $attrValue = strtolower($attrValue);

        $this->adminRepository->createAttribute($subcategory, $attrName, $attrValue);
    }
}
