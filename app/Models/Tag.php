<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;
    function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }
    function categories()
    {
        return $this->morphedByMany(Category::class, 'taggable');
    }
    protected $fillable = [
        'name',
    ];
}
