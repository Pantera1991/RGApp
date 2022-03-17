<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Pagination\LengthAwarePaginator;

interface ICommentService
{
    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(int $perPage): LengthAwarePaginator;

    /**
     * @param int $commentId
     * @return void
     */
    public function getById(int $commentId): Comment;

    /**
     * @param array $data
     * @return Comment
     */
    public function insert(array $data): Comment;

    /**
     * @param array $data
     * @param int $commentId
     * @return void
     */
    public function update(array $data, int $commentId): void;

    /**
     * @param int $commentId
     * @return void
     */
    public function delete(int $commentId): void;
}
