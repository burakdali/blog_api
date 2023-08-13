<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
    function tag(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
