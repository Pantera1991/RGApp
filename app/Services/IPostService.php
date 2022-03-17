<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

interface IPostService
{
    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(int $perPage = 10): LengthAwarePaginator;

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
