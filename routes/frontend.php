<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\frontend\HomeController;






Route::get('/', [HomeController::class, 'index'])->name('frontend.home');

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.customLogin');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.customRegister');
    })->name('register');
});


Route::get('/category/{category:id}', [HomeController::class, 'showCategoryPost'])->name('frontend.category');

Route::get('/subcategory/{subcategory:id}', [HomeController::class, 'showSubCategoryPost'])->name('frontend.subcategory');
Route::get('/tag/{tag}', [HomeController::class, 'showTagPost'])->name('frontend.tag');

Route::get('/post/{post}', [HomeController::class, 'showPost'])->name('frontend.show');
Route::get('/post-view-count/{id}', [HomeController::class, 'incrementViewCount'])->name('post.viewCount');



Route::get('/search', [HomeController::class, 'searchLive'])->name('frontend.search.live');

//routes for comment and replies

Route::group(['middleware' => 'auth'],function () {
    Route::resource('comment', CommentController::class)->names([
        'index' => 'comment.index',
        'create' => 'comment.create',
        'store' => 'comment.store',
        'show' => 'comment.show',
        'edit' => 'comment.edit',
        'update' => 'comment.update',
        'destroy' => 'comment.destroy',
    ]);

    Route::resource('reply', ReplyController::class)->names([
        'index' => 'reply.index',
        'create' => 'reply.create',
        'store' => 'reply.store',
        'show' => 'reply.show',
        'edit' => 'reply.edit',
        'update' => 'reply.update',
        'destroy' => 'reply.destroy',
    ]);
});
