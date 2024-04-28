<?php

namespace App\Repositories;

use App\Models\BlogPost;
use Illuminate\Pagination\LengthAwarePaginator;

class BlogPostRepository
{
    public function getNewestWithOptionalSearch(?string $search, string $orderDirection = 'desc', int $perPage = 10): LengthAwarePaginator
    {
        return BlogPost::when($search !== null, function ($query) use ($search) {
            $query->whereAny(['body', 'title'], 'LIKE', '%' . $search . '%');
        })->orderBy('created_at', $orderDirection)->paginate($perPage)->withQueryString();
    }
}
