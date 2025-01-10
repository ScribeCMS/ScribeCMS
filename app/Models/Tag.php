<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = [
        'name',
        'slug',
    ];

    public function entries()
    {
        return $this->belongsToMany(Entry::class, 'post_tag_pivot');
    }
}
