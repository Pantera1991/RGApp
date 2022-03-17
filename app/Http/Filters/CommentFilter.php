<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class CommentFilter extends Filter
{
    /**
     * @param string $value
     * @return Builder
     */
    public function author(string $value = ""): Builder
    {
        return $this->builder->where('author', 'like', "%{$value}%");
    }

    /**
     * @param string $value
     * @return Builder
     */
    public function content(string $value = ""): Builder
    {
        return $this->builder->where('content', 'like', "%{$value}%");
    }

    /**
     * @param string $value
     * @return Builder
     */
    public function post_id(string $value = ""): Builder
    {
        return $this->builder->where('post_id', 'like', "%{$value}%");
    }

    /**
     * @param string $value
     * @return Builder
     */
    public function sort(string $value): Builder
    {
        if (!$value) {
            return $this->builder;
        }

        try {
            [$by, $order] = explode(".", $value);
        } catch (\ErrorException $e) {
            [$by, $order] = explode(".", "created_at.desc");
        }

        if (!Schema::hasColumn("comments", $by)) {
            return $this->builder;
        }

        return $this->builder->orderBy($by, $order);
    }
}
