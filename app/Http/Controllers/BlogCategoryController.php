<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Repositories\BlogPostRepository;
use Illuminate\View\View;

class BlogCategoryController extends Controller
{
    public function __construct(private BlogPostRepository $postRepository)
    {
    }

    public function index(): View
    {
        $categories = BlogCategory::where('active', true)->orderBy('created_at', 'desc')->paginate(10);

        return view('categories/list', ['categories' => $categories]);
    }

    public function show(BlogCategory $blogCategory): View
    {
        $posts = $blogCategory->blogPosts()->orderBy('created_at', 'desc')->paginate(10);

        return view('categories/show', ['category' => $blogCategory, 'posts' => $posts]);
    }
}
