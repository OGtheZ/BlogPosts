<?php

use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogCommentController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\NewestBlogPostController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\BlogCommentOwnership;
use App\Http\Middleware\BlogPostOwnership;
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

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// No auth required routes
Route::get('/', [NewestBlogPostController::class, 'index'])->name('blog.list_newest');
Route::get('/blog/{post}/view', [BlogPostController::class, 'show'])->name('blog.show');
Route::get('/categories', [BlogCategoryController::class, 'index'])->name('categories.list');
Route::get('/category/{blogCategory}', [BlogCategoryController::class, 'show'])->name('categories.show');
Route::get('/blog/{post}/comments', [BlogCommentController::class, 'index'])->name('comments.list');

// Authenticated only
Route::middleware('auth')->group(function () {
    Route::middleware(BlogPostOwnership::class)->group(function () {
        Route::get('/blog/{post}/delete', [BlogPostController::class, 'destroy'])->name('blog.delete');
        Route::get('/blog/{post}/edit', [BlogPostController::class, 'edit'])->name('blog.edit');
        Route::post('/blog/{post}/edit', [BlogPostController::class, 'update'])->name('blog.update');
    });

    Route::get('/create-blog', [BlogPostController::class, 'create'])->name('blog.create');
    Route::post('/create-blog', [BlogPostController::class, 'store'])->name('blog.store');
    Route::get('/your-blogs', [BlogPostController::class, 'index'])->name('blog.own_list');

    Route::post('/blog/{post}/comment', [BlogCommentController::class, 'store'])->name('blog.comment');
    Route::get('/comment/{blogComment}/delete', [BlogCommentController::class, 'destroy'])->name('comment.delete')->middleware(BlogCommentOwnership::class);
});

require __DIR__.'/auth.php';
