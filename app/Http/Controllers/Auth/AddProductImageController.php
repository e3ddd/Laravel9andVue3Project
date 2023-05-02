<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddImageRequest;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Svg\Tag\Image;

class AddProductImageController extends Controller
{
    /**
     * Store product images by product id
     * @param AddImageRequest $request
     * @return void
     */
    public function store(AddImageRequest $request)
    {
        /** @var ImageService $imageService */
         $imageService = app(ImageService::class);
         $storeName = $imageService->store($request->productId, $request->file);

        if($request->hasFile('file')){
            $imageService->saveImage($request->file, $storeName);
        }

    }

    /**
     * Delete image by image id
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request)
    {
        /** @var ImageService $imageService */
        $imageService = app(ImageService::class);

        $delete = $imageService->destroy($request->id);
        if($delete){
            $imageService->deleteFromStorage($request->id);
        }
    }
}
