<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\IPostService;
use Illuminate\Http\JsonResponse;

class PostApiController extends Controller
{
    /**
     * @var IPostService
     */
    private IPostService $postService;

    /**
     * @param IPostService $postService
     */
    public function __construct(IPostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $posts = $this->postService->getAll();
        return PostResource::collection($posts->paginate(10))->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return JsonResponse
     */
    public function store(PostRequest $request): JsonResponse
    {
        $post = $this->postService->insert($request->validated());
        return (new PostResource($post))->response()->setStatusCode(JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function show(Post $post): JsonResponse
    {
        return (new PostResource($post->loadMissing('comments')))->response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @return JsonResponse
     */
    public function update(PostRequest $request, Post $post): JsonResponse
    {
        $this->postService->update($request->validated(), $post->id);
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function destroy(Post $post): JsonResponse
    {
        $this->postService->delete($post->id);
        return response()->json();
    }
}
