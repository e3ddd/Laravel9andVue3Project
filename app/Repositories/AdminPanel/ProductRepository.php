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

    public function storeAttributesValues($attrName, $attrValue, $prodId)
    {
        if (empty(ProductAttributeValue::where('product_id', $prodId)->where('name', $attrName)->get()->toArray())) {
            ProductAttributeValue::create([
                'name' => $attrName,
                'value' => $attrValue,
                'product_id' => $prodId,
            ]);
        } else {
            throw new \Exception('Attribute value exist !');
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

    public function updateAttrOrder($subcategoryId, $attrName, $order)
    {
        ProductAttribute::where('subcategory_id', $subcategoryId)->where('name', $attrName)->update(['order' => $order]);
    }

    public function storeProdAttrValues($productName, $attrs)
    {

    }

    public function storeProductSize()
    {

    }


}
