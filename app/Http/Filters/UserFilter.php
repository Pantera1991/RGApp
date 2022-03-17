<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class UserFilter extends Filter
{
    /**
     * @param string $value
     * @return Builder
     */
    public function email(string $value = ""): Builder
    {
        return $this->builder->where('email', 'like', "%{$value}%");
    }

    /**
     * @param string $value
     * @return Builder
     */
    public function name(string $value = ""): Builder
    {
        return $this->builder->where('name', 'like', "%{$value}%");
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

        if (!Schema::hasColumn("users", $by)) {
            return $this->builder;
        }

        return $this->builder->orderBy($by, $order);
    }
}
