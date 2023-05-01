<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Services\CommentsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

    public function getCommentsByProductId(Request $request)
    {
        $commentService = app(CommentsService::class);
        return $commentService->getCommentsByProductId($request->productId);
    }

    public function saveComment(CommentRequest $request)
    {
        /** @var CommentsService $commentService */
        $commentService = app(CommentsService::class);
        try {
            $commentService->saveComment(Auth::user()->id, $request->productId, $request->rate, $request->comment);
        }catch (\Exception $exception){
            throw new $exception;
        }

        $commentId = $commentService->getCommentByUserId($request->productId)->last()->id;



        foreach ($request->images as $image){
            $commentService->saveCommentImage($image, $commentId);
        }
    }
}
