<?php

namespace App\Services\AdminPanel;

use App\Http\Factories\Convert\ConvertValueManager;
use App\Repositories\AdminPanel\AttributesRepository;

class AttributesService
{
    private AttributesRepository $attributesRepository;

    public function __construct(AttributesRepository $attributesRepository)
    {
        $this->attributesRepository = $attributesRepository;
    }

    public function getConvertedAttributesValues($subcategoryId, $productId)
    {
        $convertValueManager = new ConvertValueManager();
        return $convertValueManager->getConvertValue($this->attributesRepository->getAttributesValuesByProductId($productId)->toArray(),
            $this->attributesRepository->getAttributesBySubcategoryId($subcategoryId, 0)->toArray());
    }

    public function storeAttributesValues($prodId, $subcategoryId, $attrValues)
    {
        $validValues = [];
        $convertValueManager = new ConvertValueManager();
        foreach ($attrValues as $attrValue){
            if($attrValue['type'] != 'string'){
                $validValues[$attrValue['name']] = $convertValueManager->validate($attrValue, $attrValue['type']);
            }else{
                $validValues[$attrValue['name']] = $attrValue['value'];
            }
        }

        $this->attributesRepository->storeAttributesValues($validValues, $prodId);

        $this->attributesRepository->updateAttrOrder($subcategoryId, $attrValues);
    }

    public function getAttributesBySubcategoryId($subcategoryId, $default)
    {
        return $this->attributesRepository->getAttributesBySubcategoryId($subcategoryId, $default);
    }

    public function createAttribute($subcategoryId, $attrs, $default)
    {
        $this->attributesRepository->createAttribute($subcategoryId, $attrs, $default);
    }

    public function deleteAttribute($attributeId)
    {
        $this->attributesRepository->deleteAttribute($attributeId);
    }

    public function getMagnitudeValues($magnitudeName)
    {
        return $this->attributesRepository->getMagnitudeValues($magnitudeName);
    }
}
