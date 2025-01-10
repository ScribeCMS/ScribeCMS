<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'post_id',
        'parent_id',
        'status',
        'name',
        'email',
        'url',
        'avatar',
        'body',
    ];

    public function post()
    {
        return $this->belongsTo( Post::class );
    }

    public function parent()
    {
        return $this->belongsTo( Comment::class );
    }

    public function replies()
    {
        return $this->hasMany( Comment::class, 'parent_id' );
    }

    public function user()
    {
        return $this->belongsTo( User::class );
    }
}
