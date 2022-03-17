<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

class PostService implements IPostService
{

    /**
     * @inheritDoc
     */
    public function getAll(int $perPage = 10): Builder
    {
        return Post::with(['comments']);
    }

    /**
     * @inheritDoc
     */
    public function getById(int $postId): Post
    {
        return Post::findOrFail($postId);
    }

    /**
     * @inheritDoc
     */
    public function insert(array $data): Post
    {
        return Post::create($data);
    }

    /**
     * @inheritDoc
     */
    public function update(array $data, int $postId): void
    {
        $user = Post::findOrFail($postId);
        $user->update($data);
    }

    /**
     * @inheritDoc
     */
    public function delete(int $postId): void
    {
        $post = Post::findOrFail($postId);
        $post->delete();
    }
}
