<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\CommentImage;
use http\Exception\RuntimeException;
use Imagick;

class CommentsRepository
{

    /**
     * Get comments by user id
     * @param integer|null $user_id
     * @param integer|null $product_id
     * @return mixed
     */
    public function getCommentByUserId($user_id, $product_id)
    {
        if($user_id === null){
            throw new RuntimeException('User id required');
        }

        if($product_id === null){
            throw new RuntimeException('Product id required');
        }

        return Comment::where('user_id', $user_id)->where('product_id', $product_id)->get();
    }

    /**
     * Get commets by product id
     * @param integer|null $product_id
     * @return mixed
     */
    public function getCommentsByProductId($product_id)
    {
        if($product_id === null){
            throw new RuntimeException('Product id required');
        }
        return Comment::where('product_id', $product_id)->with('images')->with('user')->paginate(10);
    }

    /**
     * Save comment
     * @param integer|null $user_id
     * @param integer|null $product_id
     * @param integer|null $rate
     * @param string|null $comment
     * @return void
     */
    public function saveComment($user_id, $product_id, $rate, $comment)
    {
        if($user_id === null){
            throw new RuntimeException('User id is required');
        }
        if($product_id === null){
            throw new RuntimeException('Product id is required');
        }
        if($rate === null){
            throw new RuntimeException('Rate is required');
        }
        if($comment === null){
            throw new RuntimeException('Comment is required');
        }

        Comment::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'rating' => $rate,
            'comment_text' => $comment
        ]);
    }

    /**
     * Store image into DB
     * @param integer|null $comment_id
     * @param string|null $hash_id
     * @return void
     */
    public function createCommentImages($comment_id, $hash_id)
    {
        if($comment_id === null){
            throw new RuntimeException('Comment id required');
        }

        if($hash_id === null){
            throw new RuntimeException('Hash id required');
        }

        if(Comment::find($comment_id)){
            CommentImage::create([
                'comment_id' => $comment_id,
                'hash_id' => $hash_id,
            ]);
        }
    }

    /**
     * Save comment image in storage
     * @param $file
     * @param string|null $storeName
     * @return void
     * @throws \ImagickException
     */
    public function saveCommentImage($file, $storeName)
    {
        if($storeName === null){
            throw new RuntimeException('Store name required');
        }
        if($file->storeAs('public/comment_images', $storeName)){
            $imgPath = storage_path() . "/app/public/comment_images/" . $storeName;
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
            $imagickSrc->resizeImage(70,50,0,1);
            $imagickSrc->writeImage($imgPath);
        }
    }
}
