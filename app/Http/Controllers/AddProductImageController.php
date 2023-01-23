<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddImageRequest;
use App\Services\ImageService;
use Illuminate\Http\Request;

class AddProductImageController extends Controller
{
    public function store(AddImageRequest $request)
    {

         $imageService = app(ImageService::class);
         $storeName = $imageService->store($request->productId, $request->file);

        if($request->hasFile('file')){
            $imageService->saveImg($request->file, $storeName);
        }
    }

    public function destroy(Request $request)
    {
        $imageService = app(ImageService::class);

        $delete = $imageService->destroy($request->id);
        if($delete){
            $imageService->deleteFromStorage($request->id);
        }
    }
}
