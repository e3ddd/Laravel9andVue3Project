<?php

namespace App\Services;

use App\Models\Product;
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

    public function store($productId, $file)
    {
        $prod = Product::find($productId);
        $userId = $prod->user->id;
        $imgHash =  $file->hashName();
        $storeName = $userId . "_" . $prod->id . "_" . $imgHash;
        $this->imageRepository->createProductImage($imgHash, $productId, $userId);

        return $storeName;
    }

    public function saveImg($file, $storeName)
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
