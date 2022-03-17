<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

interface IPostService
{
    /**
     * @param int $perPage
     * @return Builder
     */
    public function getAll(int $perPage = 10): Builder;

    /**
     * @param int $postId
     * @return void
     */
    public function getById(int $postId): Post;

    /**
     * @param array $data
     * @return Post
     */
    public function insert(array $data): Post;

    /**
     * @param array $data
     * @param int $postId
     * @return void
     */
    public function update(array $data, int $postId): void;

    /**
     * @param int $postId
     * @return void
     */
    public function delete(int $postId): void;
}
