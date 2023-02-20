<?php

namespace App\Services\AdminPanel;

use App\Repositories\AdminPanel\CategoriesAndAttributesRepository;

class CategoriesAndAttributesService
{
    private CategoriesAndAttributesRepository $categoriesAndAttributesRepository;

    public function __construct(CategoriesAndAttributesRepository $adminRepository)
    {
        $this->categoriesAndAttributesRepository = $adminRepository;
    }

    public function createCategory(string $categoryName, string|null $subcategoryName, bool|null $subCheck): void
    {
        $this->categoriesAndAttributesRepository->createCategory($categoryName, $subcategoryName, $subCheck);
    }

    public function editCategory(int $categoryId, string $newCategoryName)
    {
        return $this->categoriesAndAttributesRepository->editCategory($categoryId, $newCategoryName);
    }

    public function deleteCategory(int $categoryId)
    {
        $this->categoriesAndAttributesRepository->deleteCategory($categoryId);
    }

    public function searchCategory($search)
    {
        return $this->categoriesAndAttributesRepository->searchCategory($search);
    }

    public function createAttribute($subcategory, $attrName, $attrValue)
    {
        $attrName = strtolower($attrName);
        $attrValue = strtolower($attrValue);

        $this->categoriesAndAttributesRepository->createAttribute($subcategory, $attrName, $attrValue);
    }
}
