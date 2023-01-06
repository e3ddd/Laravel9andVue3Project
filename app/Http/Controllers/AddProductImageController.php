<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddImageRequest;
use App\Models\ProductImages;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Imagick;

class AddProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return false|string
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     * @throws \ImagickException
     */
    public function store(AddImageRequest $request, Users $users, ProductImages $images)
    {
        $userId = $users->where('email',$request->validated()['email_image'])->get('id')->toArray();
        $file = $request->file;
        $imgHash =  $file->hashName();
        $storeName = $userId[0]['id'] . "_" . $request->validated()['productId'] . "_" . $imgHash;
        if($images->where('hash_id', $imgHash)->doesntExist()){
            $images::create([
                "hash_id" => $imgHash,
                "product_id" => $request->validated()['productId'],
                "user_id" => $userId[0]['id'],
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return string
     */
    public function destroy(Request $request, ProductImages $images)
    {
        $img = $images::where('hash_id', $request->img_hash)->get()->toArray();
        $path = $img[0]['user_id'] . '_'
            . $img[0]['product_id'] . '_'
            . $img[0]['hash_id'];
        $delete = $images->where('hash_id', $request->img_hash)->delete();;
        if($delete){
            Storage::delete('public/images/' . "SMALL_" . $path);
            Storage::delete('public/images/' . $path);
        }
    }
}
