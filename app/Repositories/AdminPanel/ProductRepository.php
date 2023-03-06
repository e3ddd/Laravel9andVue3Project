<?php

namespace App\Repositories\AdminPanel;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;


class ProductRepository
{
    public function getAttributes($subcategory)
    {
        $subcategoryId = Category::where('name', $subcategory)->first()->id;

        return ProductAttribute::where('subcategory_id', $subcategoryId)->get();
    }

    public function getProductByName($productName)
    {
        return Product::where('name', $productName)->first();
    }

    public function getProductById($productId)
    {
        return Product::find($productId);
    }

    public function getAllProducts()
    {
        return Product::all();
    }

    public function getProductByCategory()
    {

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

    public function getProductBySubcategory($subcategoryId)
    {
        return Product::where('subcategory_id', $subcategoryId)->get();
    }

    public function storeProduct($productName, $productPrice, $productProducer, $productDescription, $subcategoryId)
    {
        Product::create([
            'name' => $productName,
            'price' => $productPrice,
            'producer' => $productProducer,
            'description' => $productDescription,
            'subcategory_id' => $subcategoryId
        ]);

    }

    public function updateAttrOrder($subcategoryId, $attrs)
    {
        foreach ($attrs as $attr){
            ProductAttribute::where('subcategory_id', $subcategoryId)->where('name', $attr['name'])->update(['order' => $attr['order']]);
        }
    }

    public function storeProdAttrValues($productName, $attrs)
    {

    }


}
