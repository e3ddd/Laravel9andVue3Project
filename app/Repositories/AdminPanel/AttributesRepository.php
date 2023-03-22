<?php

namespace App\Repositories\AdminPanel;

use App\Http\Enums\MagnitudeEnums\CapacityEnum;
use App\Http\Enums\MagnitudeEnums\DimensionsEnum;
use App\Http\Enums\MagnitudeEnums\WeightEnum;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;

class AttributesRepository
{
    public function getAllAttributes()
    {
        return ProductAttribute::all();
    }

    public function getAttributesBySubcategoryId($subcategoryId, $default)
    {
        return ProductAttribute::where('subcategory_id', $subcategoryId)->where('default', $default)->orderBy('order')->get();
    }

    public function getAttributesValuesByProductId($productId)
    {
        return ProductAttributeValue::where('product_id', $productId)->get();
    }

    public function createAttribute($subcategoryId, $attrs, $default)
    {
        foreach ($attrs as $attr){
            if(ProductAttribute::where('subcategory_id', $subcategoryId)
                ->where('name', strtolower($attr['name']))
                ->where('default', 0)
                ->exists()){
                throw new \Exception('This attribute already exist !');
            }
            if(ProductAttribute::where('subcategory_id', $subcategoryId)
                ->where('name', strtolower($attr['name']))
                ->where('default', 1)
                ->exists()){
                return 0;
            }
            if($attr['name'] != null && $attr['type'] != null){
                ProductAttribute::create([
                    'subcategory_id' => $subcategoryId,
                    'name' => strtolower($attr['name']),
                    'value' => $attr['type'],
                    'default' => $default,
                ]);
            }else{
                throw new \Exception('Name and type required !');
            }

        }
    }

    public function updateAttrOrder($subcategoryId, $attrs)
    {
        foreach ($attrs as $attr){
            ProductAttribute::where('subcategory_id', $subcategoryId)->where('name', $attr['name'])->update(['order' => $attr['order']]);
        }
    }

    public function deleteAttribute($attributeId)
    {
        ProductAttribute::destroy($attributeId);
    }

    public function storeAttributesValues($attrs, $prodId)
    {
        foreach ($attrs as $name => $attr){
            if(ProductAttributeValue::where('product_id', $prodId)->where('name', $name)->exists()){
                throw new \Exception('Attributes values for this product exist !');
            }else{
                ProductAttributeValue::create([
                    'name' => $name,
                    'value' => $attr,
                    'product_id' => $prodId,
                ]);
            }
        }
    }

    public function getMagnitudeValues($magnitudeName)
    {
        switch ($magnitudeName){
            case 'dimension':
                return DimensionsEnum::cases();
            case 'weight':
                return WeightEnum::cases();
            case 'capacity':
                return CapacityEnum::cases();
        }
    }
}
