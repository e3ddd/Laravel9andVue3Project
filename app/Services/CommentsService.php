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

    /**
     * Get all user comments
     * @param integer|null $userId
     * @param integer|null $product_id
     * @return mixed
     */
    public function getCommentByUserId($product_id, $userId)
    {
        return $this->commentsRepository->getCommentByUserId($userId, $product_id);
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

    /**
     * Save comment in DB
     * @param integer|null $user_id
     * @param integer|null $productId
     * @param integer|null $rate
     * @param string|null $comment_text
     * @return void
     * @throws \Exception
     */
    public function saveComment($user_id, $productId, $rate, $comment_text)
    {
        $this->commentsRepository->saveComment($user_id, $productId, $rate, $comment_text);
    }

    /**
     * Save comment image in storage
     * @param $file
     * @param integer|null $commentId
     * @return void
     * @throws \ImagickException
     */
    public function saveCommentImage($file, $commentId)
    {
        if($commentId === null){
            throw new \RuntimeException('Comment id required');
        }
        $imgHash =  $file->hashName();
        $storeName = $commentId . "_" . $imgHash;

        $this->commentsRepository->createCommentImages($commentId, $imgHash);

        $this->commentsRepository->saveCommentImage($file, $storeName);
    }


}
