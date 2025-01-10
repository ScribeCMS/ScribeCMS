<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

use App\Enums\PageStatus;

class Page extends Model
{
    /** @use HasFactory<\Database\Factories\PageFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'pages';

    protected $guarded = [
        'created_at',
        'updated_at',
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

    protected function url(): Attribute
    {
        return Attribute::make(
            get: function( $value, $attributes ) {
                return route( 'singular', [ 'slug' => $this->slug ] );
            }
        );
    }

    public function content( $format = 'raw' )
    {
        switch( $format ) {
            case 'md':
            case 'markdown':
                return Str::of( $this->body )->markdown();
            case 'raw':
            default:
                return $this->body;
        }
    }

    public function scopePublished( Builder $query )
    {
        $query->where( 'status', PageStatus::PUBLISHED );
    }

    public function scopeSlug( Builder $query, string $slug )
    {
        $query->where( 'slug', $slug );
    }
}
