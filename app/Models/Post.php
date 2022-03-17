<?php

namespace App\Models;

use App\Http\Filters\Filter;
use App\Http\Filters\Filterable;
use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Post
 *
 * @method static Builder|Post newModelQuery()
 * @method static Builder|Post newQuery()
 * @method static Builder|Post query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $author
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static PostFactory factory(...$parameters)
 * @method static Builder|Post filter(Filter $filter)
 * @method static Builder|Post whereAuthor($value)
 * @method static Builder|Post whereContent($value)
 * @method static Builder|Post whereCreatedAt($value)
 * @method static Builder|Post whereId($value)
 * @method static Builder|Post whereTitle($value)
 * @method static Builder|Post whereUpdatedAt($value)
 */
class Post extends Model
{
    use HasFactory, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'author',
    ];

    /**
     * @var string[]
     */
    public static array $sortable = [
        'id', 'title', 'author', 'created_at', 'updated_at'
    ];

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
