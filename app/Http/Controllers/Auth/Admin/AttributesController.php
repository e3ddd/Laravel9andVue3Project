<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminPanel\CategoriesAndAttributesService;
use Illuminate\Http\Request;

class AttributesController extends Controller
{
    public function getConvertedAttributesValues(Request $request)
    {
        $categoriesAndAttributesRepositoryService = app(CategoriesAndAttributesService::class);
        return $categoriesAndAttributesRepositoryService->getConvertedAttributesValues($request->subcategoryId, $request->productId);

    }

    public function getAttributesBySubcategoryId(Request $request)
    {
        $categoriesAndAttributesRepositoryService = app(CategoriesAndAttributesService::class);
        return $categoriesAndAttributesRepositoryService->getAttributesBySubcategoryId($request->subcategoryId, $request->default);
    }

    public function storeAttributesValues(Request $request)
    {
        $categoriesAndAttributesRepositoryService = app(CategoriesAndAttributesService::class);
        return $categoriesAndAttributesRepositoryService->storeAttributesValues($request->productId, $request->subcategoryId, $request->attributesValues);
    }

    public function deleteAttribute(Request $request)
    {
        $categoriesAndAttributesRepositoryService = app(CategoriesAndAttributesService::class);
        $categoriesAndAttributesRepositoryService->deleteAttribute($request->attributeId);
    }

    public function createAttribute(Request $request)
    {
        $categoriesAndAttributesRepositoryService = app(CategoriesAndAttributesService::class);
        $categoriesAndAttributesRepositoryService->createAttribute($request->subcategoryId, $request->attribute, $request->default);
    }


    public function getMagnitudeValues(Request $request)
    {
        $categoriesAndAttributesRepositoryService = app(CategoriesAndAttributesService::class);
        return $categoriesAndAttributesRepositoryService->getMagnitudeValues($request->magnitudeName);
    }
}
