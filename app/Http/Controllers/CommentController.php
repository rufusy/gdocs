<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Repositories\CommentRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Comment Management
 *
 * APIs to manage the comment resource
 */
class CommentController extends Controller
{
    /**
     * Display a listing of the comments.
     *
     * Gets a list of users
     *
     * @queryParam page_size int Size per page. Defaults to 20.
     * @queryParam page int Page to view.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $comments = Comment::query()->paginate($request->page_size ?? 20);

        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CommentRepository $commentRepository): CommentResource
    {
        $created = $commentRepository->create($request->only([
            'body',
            'user_id',
            'post_id',
        ]));

        return new CommentResource($created);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment): CommentResource
    {
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment, CommentRepository $commentRepository): CommentResource
    {
        $comment = $commentRepository->update($comment, $request->only(
            'body',
            'user_id',
            'post_id',
        ));
        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment, CommentRepository $commentRepository): JsonResponse
    {
        $deleted = $commentRepository->forceDelete($comment);

        return new JsonResponse([
            'data' => 'success',
        ]);
    }
}
