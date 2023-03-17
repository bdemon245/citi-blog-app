<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\DashboardController;



// Routes for backend activities 

Route::group(['prefix' => "admin", 'namespace' => "App\Http\Controllers\backend"], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('user', UserController::class);
    Route::resource('post', PostController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('sub-category', SubCategoryController::class);
});
