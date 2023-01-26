<?php

 namespace App\Repositories;

 use App\Models\Product;
 use App\Models\ProductImage;
 use Illuminate\Support\Facades\Storage;
 use Imagick;

 class ImageRepository
 {
     public function getImage($imgId)
     {
         return ProductImage::find($imgId);
     }

     public function getProductImage($productId)
     {
         return ProductImage::where('product_id', $productId);
     }

     public function createProductImage($imgHash, $productId, $userId)
     {
         if(ProductImage::where('hash_id', $imgHash)->doesntExist()){
             return ProductImage::create([
                 "hash_id" => $imgHash,
                 "product_id" => $productId,
                 "user_id" => $userId,
             ]);
        }
     }

     public function saveImageToStorage($file, $storeName,)
     {

             if($file->storeAs('public/images', $storeName)){
                 $imgPath = storage_path() . "/app/public/images/" . $storeName;
                 $smallImgPath = storage_path() . "/app/public/images/" . "SMALL_" . $storeName;
                 $imagickSrc = new Imagick($imgPath);
                 $compressionList = [
                     Imagick::COMPRESSION_JPEG2000
                 ];
                 $imagickDst = new Imagick();
                 $imagickDst->setCompression((int)$compressionList);
                 $imagickDst->setCompressionQuality(80);
                 $imagickDst->newPseudoImage(
                     $imagickSrc->getImageWidth(),
                     $imagickSrc->getImageHeight(),
                     'canvas:white'
                 );

                 $imagickDst->compositeImage(
                     $imagickSrc,
                     Imagick::COMPOSITE_ATOP,
                     0,
                     0
                 );
                 $imagickDst->setImageFormat("jpg");
                 $imagickSrc->resizeImage(200,200,0,1);
                 $imagickSrc->writeImage($imgPath);
                 $imagickSrc->resizeImage(50,50,0,1);
                 $imagickSrc->writeImage($smallImgPath);
             }
     }


     public function deleteImageFromStorage($imageId)
    {
        $img = $this->getImage($imageId)->get();
        $path = $img[0]['user_id'] . '_'
            . $img[0]['product_id'] . '_'
            . $img[0]['hash_id'];
        Storage::delete('public/images/' . "SMALL_" . $path);
        Storage::delete('public/images/' . $path);
    }
     public function destroyImage($imageId)
     {

         return ProductImage::destroy($imageId);
     }

 }
