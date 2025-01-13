<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

use App\Enums\PostStatus;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'slug',
        'published_at',
        'comment_count',
        'comments_on',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags_pivot');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    protected function url(): Attribute
    {
        return Attribute::make(
            get: function( $value, $attributes ) {
                return route( 'singular', [ 'slug' => $this->slug ] );
            }
        );
    }

    public function content( string $format = 'raw', int $wordLimit = 0, string $moreText = '' )
    {
        switch( $format ) {
            case 'md':
            case 'markdown':
                $content = Str::of( $this->body )->markdown();
                break;
            case 'raw':
            default:
                $content = $this->body;
        }

        if ( $wordLimit ) {
            $moreText = $moreText ?: __( 'Read more &rarr;' );
            $content = Str::words(
                $content,
                $wordLimit,
                sprintf( '&hellip; <a href="%s">%s</a>', $this->url, $moreText )
            );
        }

        return $content;
    }

    public function author()
    {
        return Attribute::make( $this->user );
    }

    public function scopePublished( Builder $query )
    {
        $query->where( 'status', PostStatus::PUBLISHED );
    }

    public function scopeSlug( Builder $query, string $slug )
    {
        $query->where( 'slug', $slug );
    }
}
