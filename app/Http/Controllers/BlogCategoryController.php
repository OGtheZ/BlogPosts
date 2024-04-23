<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogCategoryController extends Controller
{
    public function view(Request $request): View {
        $categories = BlogCategory::all();
        $selected = $request->get('category');
        $category = BlogCategory::find($selected);

        if($category !== null)
        {
            $posts = BlogPost::whereHas('blogCategories', function ($query) use($category){
                $query->where('id',$category->id);
            })->orderBy('created_at', 'desc')->paginate(10)->appends(request()->query());
            return view('categories/list', ['categories' => $categories, 'posts' => $posts]);
        }
        return view('categories/list', ['categories' => $categories]);

    }
}
