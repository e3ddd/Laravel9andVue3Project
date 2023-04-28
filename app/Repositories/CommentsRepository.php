<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\CommentImage;
use Imagick;

class CommentsRepository
{
    public function getCommentByUserId($user_id, $product_id)
    {
        return Comment::where('user_id', $user_id)->where('product_id', $product_id)->get();
    }

    public function getCommentsByProductId($product_id)
    {
        return Comment::where('product_id', $product_id)->with('images')->with('user')->paginate(10);
    }
    public function saveComment($user_id, $product_id, $rate, $comment)
    {
        Comment::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'rating' => $rate,
            'comment_text' => $comment
        ]);
    }

    public function createCommentImages($comment_id, $hash_id)
    {
        if(Comment::find($comment_id)){
            CommentImage::create([
                'comment_id' => $comment_id,
                'hash_id' => $hash_id,
            ]);
        }

    }

    public function saveCommentImage($file, $storeName)
    {
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
