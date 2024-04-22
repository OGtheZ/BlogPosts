<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class BlogPost extends Model
{
    use HasFactory;
    use Searchable;

    public function author(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany('App\Models\BlogComment');
    }

    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
            'body' => $this->body
        ];
    }
}
