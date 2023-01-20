<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddImageRequest;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use ErrorException;
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
            if(ProductImage::where('hash_id', $imgHash)->doesntExist()){
                ProductImage::create([
                    "hash_id" => $imgHash,
                    "product_id" => $prod->id,
                    "user_id" => $userId,
                ]);

                if($request->hasFile('file')){
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

                        $imagickSrc->resizeImage(270,270,0,1);
                        $imagickSrc->writeImage($imgPath);
                        $imagickSrc->resizeImage(90,90,0,1);
                        $imagickSrc->writeImage($smallImgPath);
                    }
                }
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
        $img = ProductImage::find($request->id)->get();
        $path = $img[0]['user_id'] . '_'
            . $img[0]['product_id'] . '_'
            . $img[0]['hash_id'];
        $delete = ProductImage::find($request->id)->delete();;
        if($delete){
            Storage::delete('public/images/' . "SMALL_" . $path);
            Storage::delete('public/images/' . $path);
        }
    }
}
