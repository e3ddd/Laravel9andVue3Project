<?php

namespace App\Repositories\AdminPanel;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;


class ProductRepository
{
    public function getAttributeByName($attrName)
    {
        return ProductAttribute::where('name', $attrName)->first();
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

    public function getProductBySubcategoryIdWithPaginate($subcategoryId)
    {
        return Product::where('subcategory_id', $subcategoryId)->with('image')->paginate(10);
    }

    public function searchProduct($search)
    {
        return Product::where('name', 'like', $search . '%')->paginate(10);
    }

    public function deleteProduct($productId)
    {
        Product::destroy($productId);
    }

    public function storeProduct($productName, $productPrice, $productProducer, $productDescription, $subcategoryId)
    {
        if(Product::where('name', $productName)->exists()){
            throw new \Exception('Product name exist !');
        }else{
            Product::create([
                'name' => $productName,
                'price' => $productPrice,
                'producer' => $productProducer,
                'description' => $productDescription,
                'subcategory_id' => $subcategoryId
            ]);
        }

    }

    public function updateAttrOrder($subcategoryId, $attrs)
    {
        foreach ($attrs as $attr){
            ProductAttribute::where('subcategory_id', $subcategoryId)->where('name', $attr['name'])->update(['order' => $attr['order']]);
        }
    }

}
