<?php

use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogCommentController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\BlogCommentOwnership;
use App\Http\Middleware\BlogPostOwnership;
use App\Http\Middleware\ResourceOwnership;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [BlogPostController::class, 'viewNewest'])->name('blog.view_new');
Route::get('/blog/{post}/view', [BlogPostController::class, 'view'])->name('blog.view');
Route::get('/categories', [BlogCategoryController::class, 'view'])->name('categories.list');
Route::get('/categories/{category}/blogs', [BlogCategoryController::class, 'viewBlogs'])->name('categories.blogs');

Route::middleware('auth')->group(function () {
    Route::middleware(BlogPostOwnership::class)->group(function () {
        Route::get('/blog/{post}/delete', [BlogPostController::class, 'delete'])->name('blog.delete');
        Route::get('/blog/{post}/edit', [BlogPostController::class, 'updateView'])->name('blog.edit');
        Route::post('/blog/{post}/edit', [BlogPostController::class, 'update'])->name('blog.edit');
    });

    Route::get('/create-blog', [BlogPostController::class, 'create'])->name('blog.create');
    Route::post('/create-blog', [BlogPostController::class, 'store'])->name('blog.store');
    Route::get('/your-blogs', [BlogPostController::class, 'listOwn'])->name('blog.own_list');

    Route::post('/blog/{post}/comment', [BlogCommentController::class, 'store'])->name('blog.comment');
    Route::get('/comment/{blogComment}/delete', [BlogCommentController::class, 'delete'])->name('comment.delete')->middleware(BlogCommentOwnership::class);
});




require __DIR__.'/auth.php';
