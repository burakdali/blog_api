<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
    function tag(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
    protected $fillable = [
        'title',
        'content',
        'status',
        'user_id',
        'category_id'
    ];
}
