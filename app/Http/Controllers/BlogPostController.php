<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogPostCreateRequest;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    public function store(BlogPostCreateRequest $request): RedirectResponse {
        $validated = $request->safe()->only(['body', 'title', 'categories']);
        $user = auth()->user();

        $blogPost = new BlogPost();
        $blogPost->title = strip_tags($validated['title']);
        $blogPost->body = strip_tags($validated['body'], '<p><br>');
        $blogPost->author_id = $user->id;
        $blogPost->save();

        if(isset($validated['categories'])) {
            $blogPost->blogCategories()->attach($validated['categories']);
        }

        return redirect()->route('blog.own_list');
    }

    public function create(): View {
        $categories = BlogCategory::all();
        return view('blog/create_view', ['categories' => $categories]);
    }

    public function listOwn(): View {
        $user = auth()->user();
        $posts = BlogPost::where('author_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('blog/list', ['posts' => $posts]);
    }

    public function view(BlogPost $post): View
    {
        return view('blog/view', ['post' => $post]);
    }

    public function delete(BlogPost $post): RedirectResponse {
        $post->delete();
        return redirect()->route('blog.own_list');
    }

    public function updateView(BlogPost $post): View {
        $categories = BlogCategory::all();
        $setCategoryArray = $post->blogCategories()->pluck('id')->toArray();
        return view('blog/update_view', ['post' => $post, 'categories' => $categories, 'setCategories' => $setCategoryArray]);
    }

    public function update(BlogPost $post, BlogPostUpdateRequest $request): RedirectResponse {
        $validated = $request->safe()->only(['body', 'title', 'categories']);
        $post->title = strip_tags($validated['title']);
        $post->body = strip_tags($validated['body'],'<p><br>');
        $post->blogCategories()->detach();
        $post->blogCategories()->attach($validated['categories']);
        $post->save();

        return redirect()->route('blog.own_list');
    }

    public function viewNewest(Request $request): View {
        $search = $request->get('search');
        $search === null ? $posts = BlogPost::orderBy('created_at', 'DESC')->paginate(10) :
            $posts = BlogPost::search($search)->orderBy('created_at', 'desc')->paginate(10);

        return view('blog/list', ['posts' => $posts]);
    }
}
