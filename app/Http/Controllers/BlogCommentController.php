<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogCommentRequest;
use App\Models\BlogComment;
use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BlogCommentController extends Controller
{
    public function store(StoreBlogCommentRequest $request, BlogPost $post): RedirectResponse
    {
        $post->comments()->create([...$request->validated(), 'author_id' => $request->user()->id]);

        return redirect()->back();
    }

    public function destroy(BlogComment $blogComment): RedirectResponse
    {
        $blogComment->delete();

        return redirect()->back();
    }

    public function index(BlogPost $post): View
    {
        $comments = $post->comments()->orderBy('created_at', 'desc')->paginate(10);

        return view('blog/comments', ['post' => $post, 'comments' => $comments]);
    }
}
