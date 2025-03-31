<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    protected $guarded = [];

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'taggable')
            // ->withTimestamps()
        ;
    }

    public function videos(): MorphToMany
    {
        return $this->morphedByMany(Video::class, 'taggable')
            // ->withTimestamps()
        ;
    }
}
