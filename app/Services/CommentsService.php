<?php

namespace App\Services;

use App\Repositories\CommentsRepository;
use Illuminate\Support\Facades\Auth;

class CommentsService
{
    private CommentsRepository $commentsRepository;

    public function __construct(CommentsRepository $commentsRepository)
    {
        $this->commentsRepository = $commentsRepository;
    }

    public function getCommentByUserId($product_id)
    {
        return $this->commentsRepository->getCommentByUserId(Auth::user()->id, $product_id);
    }

    /**
     * Get comments by product id
     * @param integer|null $product_id
     * @return mixed
     */
    public function getCommentsByProductId($product_id)
    {
        return $this->commentsRepository->getCommentsByProductId($product_id);
    }

    public function saveComment($user_id, $productId, $rate, $comment_text)
    {
        try {
            $this->commentsRepository->saveComment($user_id, $productId, $rate, $comment_text);
        }catch (\Exception $exception){
            throw new $exception;
        }
    }

    public function saveCommentImage($file, $commentId)
    {
        $imgHash =  $file->hashName();
        $storeName = $commentId . "_" . $imgHash;

        $this->commentsRepository->createCommentImages($commentId, $imgHash);

        $this->commentsRepository->saveCommentImage($file, $storeName);
    }


}
