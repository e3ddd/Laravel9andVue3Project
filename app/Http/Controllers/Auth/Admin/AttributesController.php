<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminPanel\AttributesService;
use Illuminate\Http\Request;

class AttributesController extends Controller
{
    public function getConvertedAttributesValues(Request $request)
    {
        $attributeService = app(AttributesService::class);
        return $attributeService->getConvertedAttributesValues($request->subcategoryId, $request->productId);

    }

    public function getAttributesBySubcategoryId(Request $request)
    {
        $attributeService = app(AttributesService::class);
        return $attributeService->getAttributesBySubcategoryId($request->subcategoryId, $request->default);
    }

    public function storeAttributesValues(Request $request)
    {
        $attributeService = app(AttributesService::class);
        return $attributeService->storeAttributesValues($request->productId, $request->subcategoryId, $request->attributesValues);
    }

    public function deleteAttribute(Request $request)
    {
        $attributeService = app(AttributesService::class);
        $attributeService->deleteAttribute($request->attributeId);
    }

    public function createAttribute(Request $request)
    {
        $attributeService = app(AttributesService::class);
        $attributeService->createAttribute($request->subcategoryId, $request->attribute, $request->default);
    }


    public function getMagnitudeValues(Request $request)
    {
        $attributeService = app(AttributesService::class);
        return $attributeService->getMagnitudeValues($request->magnitudeName);
    }
}
