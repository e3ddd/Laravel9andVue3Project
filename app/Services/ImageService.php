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

    public function store($imgHash, $productId, $userId)
    {
        return $this->imageRepository->createProductImage($imgHash, $productId, $userId);
    }

    public function saveImg($file, $storeName)
    {
       $this->imageRepository->saveImageToStorage($file, $storeName);
    }

    public function destroy($imageId)
    {
        return $this->imageRepository->destroyImage($imageId);
    }

    public function deleteFromStorage($id)
    {
        $this->imageRepository->deleteImageFromStorage($id);
    }
}
