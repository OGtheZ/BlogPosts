<?php

namespace App\Http\Controllers;

use App\Repositories\BlogPostRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewestBlogPostController extends Controller
{
    public function __construct(private BlogPostRepository $postRepository)
    {
    }

    public function index(Request $request): View
    {
        $posts = $this->postRepository->getNewestWithOptionalSearch($request->get('search'));

        return view('blog/list', ['posts' => $posts]);
    }
}
