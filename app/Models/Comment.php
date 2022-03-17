<?php

namespace App\Models;

use App\Http\Filters\Filter;
use App\Http\Filters\Filterable;
use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Comment
 *
 * @method static CommentFactory factory(...$parameters)
 * @method static Builder|Comment filter(Filter $filter)
 * @method static Builder|Comment newModelQuery()
 * @method static Builder|Comment newQuery()
 * @method static Builder|Comment query()
 * @mixin \Eloquent
 */
class Comment extends Model
{
    use HasFactory, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'author', 'post_id'
    ];

    /**
     * @var string[]
     */
    public static array $sortable = [
        'id', 'content', 'author', 'created_at', 'updated_at', 'post_id'
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
