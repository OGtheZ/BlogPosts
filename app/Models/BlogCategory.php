<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BlogCategory extends Model
{
    use HasFactory;

    public function blogPosts(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\BlogPost');
    }
}
