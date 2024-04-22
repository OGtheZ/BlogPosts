<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\View\View;

class BlogCategoryController extends Controller
{
    public function view(): View {
        $categories = BlogCategory::all();
        return view('categories/list', ['categories' => $categories]);
    }

    public function viewBlogs(BlogCategory $category): View
    {
        $categories = BlogCategory::all();
        $posts = $category->blogPosts()->get();

        return view('categories/list', ['categories' => $categories, 'posts' => $posts]);
    }
}
