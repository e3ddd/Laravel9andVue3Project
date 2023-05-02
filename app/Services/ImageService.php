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

    /**
     * Get image by id
     * @param integer|null $imageId
     * @return mixed
     */
    public function get($imageId)
    {
        return $this->imageRepository->getImage($imageId);
    }

    /**
     * Get image by product id
     * @param $productId
     * @return mixed
     */
    public function getPrdImg($productId)
    {
        return $this->imageRepository->getProductImage($productId);
    }

    /**
     * Save image to DB
     * @param integer|null $productId
     * @param $fileName
     * @return string
     */
    public function storeImage($productId, $fileName)
    {
        $imgHash =  $fileName->hashName();
        $storeName = $productId . "_" . $imgHash;
        $this->imageRepository->createProductImage($imgHash, $productId);

        return $storeName;
    }

    /**
     * Store image to storage
     * @param $file
     * @param string|null $storeName
     * @return void
     */
    public function saveImage($file, $storeName)
    {
       $this->imageRepository->saveImageToStorage($file, $storeName);
    }

    /**
     * Delete image by id
     * @param $imageId
     * @return int
     */
    public function destroy($imageId)
    {
        return $this->imageRepository->destroyImage($imageId);
    }

    /**
     * Delete image by id from storage
     * @param $imageId
     * @return void
     */
    public function deleteFromStorage($imageId)
    {
        $this->imageRepository->deleteImageFromStorage($imageId);
    }
}
