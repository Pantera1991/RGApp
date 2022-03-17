<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentService implements ICommentService
{

    public function getAll(int $perPage): LengthAwarePaginator
    {
        return Comment::paginate($perPage);
    }

    public function getById(int $commentId): Comment
    {
        return Comment::findOrFail($commentId);
    }

    public function insert(array $data): Comment
    {
        return Comment::create($data);
    }

    public function update(array $data, int $commentId): void
    {
        $user = Comment::findOrFail($commentId);
        $user->update($data);
    }

    public function delete(int $commentId): void
    {
        $post = Comment::findOrFail($commentId);
        $post->delete();
    }
}
