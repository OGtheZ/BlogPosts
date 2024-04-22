<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogCommentRequest;
use App\Http\Requests\UpdateBlogCommentRequest;
use App\Models\BlogComment;
use App\Models\BlogPost;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;

class BlogCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogCommentRequest $request, BlogPost $post): RedirectResponse
    {
        $user = auth()->user();
        $body = strip_tags($request->validated('body'));

        $comment = new BlogComment();
        $comment->author_id = $user->id;
        $comment->blog_post_id = $post->id;
        $comment->body = $body;
        $comment->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     */
    public function delete(BlogComment $blogComment): RedirectResponse
    {
        $this->authorize('delete', $blogComment);
        $blogComment->delete();
        return redirect()->back();
    }
}
