<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Services\ICommentService;
use Illuminate\Http\JsonResponse;

class CommentApiController extends Controller
{

    private ICommentService $commentService;

    /**
     * @param ICommentService $commentService
     */
    public function __construct(ICommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $comments = $this->commentService->getAll(10);
        return CommentResource::collection($comments)->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $request
     * @return JsonResponse
     */
    public function store(CommentRequest $request): JsonResponse
    {
        $post = $this->commentService->insert($request->validated());
        return (new CommentResource($post))->response()->setStatusCode(JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @return JsonResponse
     */
    public function show(Comment $comment): JsonResponse
    {
        return (new CommentResource($comment))->response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CommentRequest $request
     * @param Comment $comment
     * @return JsonResponse
     */
    public function update(CommentRequest $request, Comment $comment): JsonResponse
    {
        $this->commentService->update($request->validated(), $comment->id);
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return JsonResponse
     */
    public function destroy(Comment $comment): JsonResponse
    {
        $this->commentService->delete($comment->id);
        return response()->json();
    }
}
