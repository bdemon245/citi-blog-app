<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/post/{post}', [HomeController::class, 'showPost'])->name('frontend.show');
Route::get('/post-view-count/{id}', [HomeController::class, 'incrementViewCount'])->name('post.viewCount');



Route::get('/search', [HomeController::class, 'searchLive'])->name('frontend.search.live');
