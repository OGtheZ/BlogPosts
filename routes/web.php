<?php

use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\ProfileController;
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

Route::middleware('auth')->group(function () {
    Route::get('/create-blog', [BlogPostController::class, 'create'])->name('blog.create');
    Route::post('/create-blog', [BlogPostController::class, 'store'])->name('blog.create');
    Route::get('/your-blogs', [BlogPostController::class, 'listOwn'])->name('blog.own_list');
    Route::get('/blog/{post}/view', [BlogPostController::class, 'view'])->name('blog.view');
    Route::get('/blog/{post}/delete', [BlogPostController::class, 'delete'])->name('blog.delete');
    Route::get('/blog/{post}/edit', [BlogPostController::class, 'updateView'])->name('blog.edit');
    Route::post('/blog/{post}/edit', [BlogPostController::class, 'update'])->name('blog.edit');
    Route::get('/blog/new', [BlogPostController::class, 'viewNewest'])->name('blog.view_new');
});

require __DIR__.'/auth.php';
