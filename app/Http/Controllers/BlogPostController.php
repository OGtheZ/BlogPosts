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

        $blogPost->blogCategories()->attach($validated['categories']);

        return redirect()->route('blog.own_list');
    }

    public function create(): View {
        $categories = BlogCategory::all();
        return view('blog/create_view', ['categories' => $categories]);
    }

    public function listOwn(): View {
        $user = auth()->user();
        $posts = BlogPost::where('author_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('blog/list', ['posts' => $posts]);
    }

    public function view(BlogPost $post): View
    {
        return view('blog/view', ['post' => $post]);
    }

    /**
     * @throws AuthorizationException
     */
    public function delete(BlogPost $post): RedirectResponse {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('blog.own_list');
    }

    /**
     * @throws AuthorizationException
     */
    public function updateView(BlogPost $post): View {
        $this->authorize('updateView', $post);
        return view('blog/update_view', ['post' => $post]);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(BlogPost $post, BlogPostUpdateRequest $request): RedirectResponse {
        $this->authorize('update', $post);
        $validated = $request->safe()->only(['body', 'title']);
        $post->title = strip_tags($validated['title']);
        $post->body = strip_tags($validated['body'],'<p><br>');
        $post->save();

        return redirect()->route('blog.own_list');
    }

    public function viewNewest(Request $request): View {
        $search = $request->get('search');
        $search === null ? $posts = BlogPost::orderBy('created_at', 'DESC')->get() :
            $posts = BlogPost::search($search)->orderBy('created_at', 'desc')->get();

        return view('blog/list', ['posts' => $posts]);
    }
}
