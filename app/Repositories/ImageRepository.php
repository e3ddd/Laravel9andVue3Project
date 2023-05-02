<?php

 namespace App\Repositories;

 use App\Models\ProductImage;
 use http\Exception\RuntimeException;
 use Illuminate\Support\Facades\Storage;
 use Imagick;

 class ImageRepository
 {
     /**
      * Get image by id
      * @param integer|null $imgId
      * @return mixed
      */
     public function getImage($imgId)
     {
         if($imgId === null){
             throw new RuntimeException('Image id required');
         }

         return ProductImage::find($imgId);
     }


     /**
      * Get product images by product id
      * @param integer|null $productId
      * @return mixed
      */
     public function getProductImage($productId)
     {
         if($productId === null){
             throw new RuntimeException('Product id required');
         }
         return ProductImage::where('product_id', $productId);
     }

     /**
      * Store image name to DB
      * @param string|null $imgHash
      * @param integer|null $productId
      * @return void
      */
     public function createProductImage($imgHash, $productId)
     {
         if($productId === null){
             throw new \RuntimeException('Product id required');
         }

         if($imgHash === null){
             throw new \RuntimeException('Hash id required');
         }

         if(ProductImage::where('hash_id', $imgHash)->doesntExist()){
             return ProductImage::create([
                 "hash_id" => $imgHash,
                 "product_id" => $productId,
             ]);
        }
     }

     /**
      * Save image to storage
      * @param $file
      * @param string|null $storeName
      * @return void
      * @throws \ImagickException
      */
     public function saveImageToStorage($file, $storeName)
     {
            if($storeName === null){
                throw new \RuntimeException('Store name required');
            }

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
                 $imagickSrc->resizeImage(250,200,0,1);
                 $imagickSrc->writeImage($imgPath);
                 $imagickSrc->resizeImage(70,50,0,1);
                 $imagickSrc->writeImage($smallImgPath);
             }
     }

     /**
      * Delete image from storage
      * @param integer|null $imageId
      * @return void
      */
     public function deleteImageFromStorage($imageId)
    {
        $img = $this->getImage($imageId)->get();

        if($img->isEmpty()){
            throw new \RuntimeException('Image not found');
        }

        $path = $img[0]['user_id'] . '_'
            . $img[0]['product_id'] . '_'
            . $img[0]['hash_id'];
        Storage::delete('public/images/' . "SMALL_" . $path);
        Storage::delete('public/images/' . $path);
    }

     /**
      * Delete image from DB
      * @param integer|null $imageId
      * @return int
      */
     public function destroyImage($imageId)
     {
         if($imageId === null) {
             throw new \RuntimeException('Image id required');
         }
         return ProductImage::destroy($imageId);
     }

 }
