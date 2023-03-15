<?php

namespace App\Services\AdminPanel;

use App\Http\Factories\Convert\ConvertValueManager;
use App\Repositories\AdminPanel\CategoriesAndAttributesRepository;

class CategoriesAndAttributesService
{
    private CategoriesAndAttributesRepository $categoriesAndAttributesRepository;

    public function __construct(CategoriesAndAttributesRepository $adminRepository)
    {
        $this->categoriesAndAttributesRepository = $adminRepository;
    }

    public function getConvertedAttributesValues($subcategoryId, $productId)
    {
        $convertValueManager = new ConvertValueManager();
        return $convertValueManager->getConvertValue($this->categoriesAndAttributesRepository->getAttributesValuesByProductId($productId)->toArray(),
            $this->categoriesAndAttributesRepository->getAttributesBySubcategoryId($subcategoryId, 0)->toArray());
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

    public function getAttributesBySubcategoryId($subcategoryId, $default)
    {
        return $this->categoriesAndAttributesRepository->getAttributesBySubcategoryId($subcategoryId, $default);
    }

    public function createAttribute($subcategoryId, $attrs, $default)
    {
        $this->categoriesAndAttributesRepository->createAttribute($subcategoryId, $attrs, $default);
    }

    public function deleteAttribute($attributeId)
    {
        $this->categoriesAndAttributesRepository->deleteAttribute($attributeId);
    }

    public function getMagnitudeValues($magnitudeName)
    {
        return $this->categoriesAndAttributesRepository->getMagnitudeValues($magnitudeName);
    }
}
