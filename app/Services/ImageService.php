<?php

namespace App\Services;

use App\Repositories\ImageRepository;

class ImageService
{
    private ImageRepository $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function get($imageId)
    {
        return $this->imageRepository->getImage($imageId);
    }

    public function getPrdImg($productId)
    {
        return $this->imageRepository->getProductImage($productId);
    }

    public function storeImage($productId, $fileName)
    {
        $imgHash =  $fileName->hashName();
        $storeName = $productId . "_" . $imgHash;
        $this->imageRepository->createProductImage($imgHash, $productId);

        return $storeName;
    }

    public function saveImage($file, $storeName)
    {
       $this->imageRepository->saveImageToStorage($file, $storeName);
    }

    public function destroy($imageId)
    {
        return $this->imageRepository->destroyImage($imageId);
    }

    public function deleteFromStorage($imageId)
    {
        $this->imageRepository->deleteImageFromStorage($imageId);
    }
}
