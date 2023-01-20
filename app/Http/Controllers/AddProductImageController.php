<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddImageRequest;
use App\Models\Product;
use App\Repositories\ImageRepository;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Imagick;

class AddProductImageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return false
     * @throws \ImagickException
     */
    public function store(AddImageRequest $request)
    {
        $prod = Product::find($request->productId);
        $userId = $prod->user->id;
        $file = $request->file;
        $imgHash =  $file->hashName();
        $storeName = $userId . "_" . $prod->id . "_" . $imgHash;

         $imageService = new ImageService(app(ImageRepository::class));
         $imageService->store($imgHash, $request->productId, $userId);

        if($request->hasFile('file')){
            $imageService->saveImg($request->file, $storeName);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return string
     */
    public function destroy(Request $request)
    {
        $imageService = new ImageService(app(ImageRepository::class));

        $delete = $imageService->destroy($request->id);
        if($delete){
            $imageService->deleteFromStorage($request->id);
        }
    }
}
