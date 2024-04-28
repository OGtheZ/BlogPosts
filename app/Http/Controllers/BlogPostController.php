<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogPostCreateRequest;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    public function index(): View
    {
        $posts = auth()->user()->blogPosts()->orderBy('created_at', 'desc')->paginate(10);

        return view('blog/list', ['posts' => $posts]);
    }

    public function create(): View
    {
        $categories = BlogCategory::where('active', true)->get();
        return view('blog/create_view', ['categories' => $categories]);
    }

    public function store(BlogPostCreateRequest $request): RedirectResponse
    {
        $blogPost = auth()->user()->blogPosts()->create($request->only(['body', 'title']));
        $blogPost->blogCategories()->attach($request->validated(['categories']));

        return redirect()->route('blog.own_list');
    }

    public function show(BlogPost $post): View
    {
        $post->load(['comments' => function ($query) {
            $query->orderBy('created_at', 'desc')->limit(5);
        }]);
        return view('blog/view', ['post' => $post]);
    }

    public function destroy(BlogPost $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('blog.own_list');
    }

    public function edit(BlogPost $post): View
    {
        $post->load('blogCategories');
        $setCategoryArray = $post->blogCategories->pluck('id')->toArray();
        $categories = BlogCategory::where('active', true)->get();

        return view('blog/update_view', ['post' => $post, 'categories' => $categories, 'setCategories' => $setCategoryArray]);
    }

    public function update(BlogPostUpdateRequest $request, BlogPost $post): RedirectResponse
    {
        $post->update($request->only(['title', 'body']));
        $post->blogCategories()->sync($request['categories']);

        return redirect()->route('blog.own_list');
    }
}
