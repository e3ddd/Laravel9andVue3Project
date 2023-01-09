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
     * @return false
     * @throws \ImagickException
     */
    public function store(AddImageRequest $request, User $user, ProductImage $image, Product $product)
    {
        if($product::where('id', $request->productId)->get('email')[0]->email == $request->email_image){
            $userId = $user->where('email',$request->validated()['email_image'])->get('id')->toArray();
            $file = $request->file;
            $imgHash =  $file->hashName();
            $storeName = $userId[0]['id'] . "_" . $request->validated()['productId'] . "_" . $imgHash;
            if($image->where('hash_id', $imgHash)->doesntExist()){
                $image::create([
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
        }else{
            return throw new ErrorException('The user with this e-mail does not have a product with the entered id');
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
    public function destroy(Request $request, ProductImage $image)
    {
        $img = $image::where('hash_id', $request->img_hash)->get()->toArray();
        $path = $img[0]['user_id'] . '_'
            . $img[0]['product_id'] . '_'
            . $img[0]['hash_id'];
        $delete = $image->where('hash_id', $request->img_hash)->delete();;
        if($delete){
            Storage::delete('public/images/' . "SMALL_" . $path);
            Storage::delete('public/images/' . $path);
        }
    }
}
