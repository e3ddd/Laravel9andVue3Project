<?php

namespace App\Repositories\AdminPanel;

use App\Http\Enums\MagnitudeEnums\CapacityEnum;
use App\Http\Enums\MagnitudeEnums\DimensionsEnum;
use App\Http\Enums\MagnitudeEnums\WeightEnum;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Models\ProductSize;
use Exception;

class ProductRepository
{
    public function getAttributes($subcategory)
    {
        $subcategoryId = Category::where('name', $subcategory)->first()->id;

        $productAttributes = ProductAttribute::where('subcategory_id', $subcategoryId)->get();
        foreach ($productAttributes as $attribute){
            switch ($attribute['name']){
                case 'size':
                    foreach (DimensionsEnum::cases() as $case){
                        if($case->name == $attribute['dimension']){
                            $productAttributes[] = ['alt_dimension' => $case->value];
                        }
                    }
                case 'weight':
                    foreach (WeightEnum::cases() as $case){
                        if($case->name == $attribute['dimension']){
                            $productAttributes[] = ['alt_weight' => $case->value];
                        }
                    }
                case 'capacity':
                    foreach (CapacityEnum::cases() as $case){
                        if($case->name == $attribute['dimension']){
                            $productAttributes[] = ['alt_capacity' => $case->value];
                        }
                    }
            }
        }
        return $productAttributes;
    }

    public function storeProduct($productName, $productCategory)
    {
            Product::create([
                'name' => $productName,
                'category_id' => $productCategory
            ]);
    }

    public function storeAttrOrder($subcategory, $attrOrder)
    {
        $subcategoryId = Category::where('name', $subcategory)->first()->id;

            foreach ($attrOrder as $key => $value){
                ProductAttribute::where('subcategory_id', $subcategoryId)->where('name', $key)->update(['order' => $value]);
            }

    }

    public function storeProductSize($productName, $productSize)
    {
        $prodSize = $productSize;
        $prodSize['product_id'] = Product::where('name', $productName)->first()->toArray()['id'];
        ProductSize::create($prodSize);
    }

    public function storeProductAttrValue($attrValues)
    {
        foreach ($attrValues as $key => $value){
           ProductAttributeValue::create([
               'name' => $key,

           ]);
        }
    }


}
