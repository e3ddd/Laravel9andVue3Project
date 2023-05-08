<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Services\CommentsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

    /**
     * Get comments by product id
     * @param Request $request
     * @return mixed
     */
    public function getCommentsByProductId(Request $request)
    {
        /** @var CommentsService $commentService */
        $commentService = app(CommentsService::class);
        return $commentService->getCommentsByProductId($request->productId);
    }

    /**
     * Save comment by prodcut id
     * @param CommentRequest $request
     * @return void
     * @throws \Exception
     */
    public function saveComment(CommentRequest $request)
    {
        /** @var CommentsService $commentService */
        $commentService = app(CommentsService::class);
        try {
            $commentService->saveComment(Auth::user()->id, $request->productId, $request->rate, $request->comment);
        }catch (\Exception $exception){
            throw new $exception;
        }

        $commentId = $commentService->getCommentByUserId($request->productId, Auth::user()->id)->last()->id;

        foreach ($request->images as $image){
            $commentService->saveCommentImage($image, $commentId);
        }
    }
}
