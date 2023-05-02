<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminPanel\AttributesService;
use Illuminate\Http\Request;

class AttributesController extends Controller
{
    /**
     * Get converted attributes values
     * @param Request $request
     * @return mixed
     */
    public function getConvertedAttributesValues(Request $request)
    {
        /** @var AttributesService $attributeService */
        $attributeService = app(AttributesService::class);
        return $attributeService->getConvertedAttributesValues($request->subcategoryId, $request->productId);

    }

    /**
     * Get attributes by subcategory id
     * @param Request $request
     * @return mixed
     */
    public function getAttributesBySubcategoryId(Request $request)
    {
        /** @var AttributesService $attributeService */
        $attributeService = app(AttributesService::class);
        return $attributeService->getAttributesBySubcategoryId($request->subcategoryId, $request->default);
    }

    /**
     * Store attributes values
     * @param Request $request
     * @return mixed
     */
    public function storeAttributesValues(Request $request)
    {
        /** @var AttributesService $attributeService */
        $attributeService = app(AttributesService::class);
        $attributeService->storeAttributesValues($request->productId, $request->subcategoryId, $request->attributesValues);
    }

    /**
     * Delete attribute
     * @param Request $request
     * @return void
     */
    public function deleteAttribute(Request $request)
    {
        /** @var AttributesService $attributeService */
        $attributeService = app(AttributesService::class);
        $attributeService->deleteAttribute($request->attributeId);
    }

    /**
     * Create attribute
     * @param Request $request
     * @return void
     */
    public function createAttribute(Request $request)
    {
        /** @var AttributesService $attributeService */
        $attributeService = app(AttributesService::class);
        $attributeService->createAttribute($request->subcategoryId, $request->attribute, $request->default);
    }

    /**
     * Get magnitude values
     * @param Request $request
     * @return mixed
     */
    public function getMagnitudeValues(Request $request)
    {
        /** @var AttributesService $attributeService */
        $attributeService = app(AttributesService::class);
        return $attributeService->getMagnitudeValues($request->magnitudeName);
    }
}
