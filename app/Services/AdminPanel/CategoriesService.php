<?php

namespace App\Services\AdminPanel;

use App\Repositories\AdminPanel\CategoriesRepository;

class CategoriesService
{
    private CategoriesRepository $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function getAllCategories()
    {
        return $this->categoriesRepository->getAllCategories();
    }
    public function getAllCategoriesWithPagination()
    {
        return $this->categoriesRepository->getAllCategoriesWithPagination();
    }

    public function getSubcategoriesByParentCategoryName($categoryName)
    {
        return $this->categoriesRepository->getSubcategoriesByParentCategoryName($categoryName);
    }

    public function createCategory($categoryName, $subcategoryName, $subCheck): void
    {
        $this->categoriesRepository->createCategory($categoryName, $subcategoryName, $subCheck);
    }
    public function editCategory($categoryId, $newCategoryName)
    {
        return $this->categoriesRepository->editCategory($categoryId, $newCategoryName);
    }
    public function deleteCategory($categoryId)
    {
        $this->categoriesRepository->deleteCategory($categoryId);
    }
    public function searchCategory($search)
    {
        return $this->categoriesRepository->searchCategory($search);
    }
}
