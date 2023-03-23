<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\SubCategoryController;



// Routes for backend activities 

Route::group(['prefix' => "admin", 'middleware' => ['not_role:user', 'auth']], function () {
    //route for admin dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    //routes for user control
    Route::resource('user', UserController::class)->names([
        'index' => 'user.index',
        'create' => 'user.create',
        'store' => 'user.store',
        'show' => 'user.show',
        'edit' => 'user.edit',
        'update' => 'user.update',
        'destroy' => 'user.destroy',
    ])->middleware('role:super admin|admin');

    //routes for post control

    Route::resource('post', PostController::class)->names([
        'index' => 'post.index',
        'create' => 'post.create',
        'store' => 'post.store',
        'show' => 'post.show',
        'edit' => 'post.edit',
        'update' => 'post.update',
        'destroy' => 'post.destroy',
    ]);

    Route::patch('post/{post}/toggle-banner', [PostController::class, 'toggleBanner'])->name('post.toggleBanner')->middleware('permission:toggle post');

    //routes for role control
    Route::resource('role', RoleController::class)->names([
        'index' => 'role.index',
        'create' => 'role.create',
        'store' => 'role.store',
        'show' => 'role.show',
        'edit' => 'role.edit',
        'update' => 'role.update',
        'destroy' => 'role.destroy',
    ]);

    //routes for category control

    Route::resource('category', CategoryController::class)->names([
        'index' => 'category.index',
        'store' => 'category.store',
        'edit' => 'category.edit',
        'update' => 'category.update',
        'destroy' => 'category.destroy',
    ]);

    //routes for sub_category control
    Route::resource('sub-category', SubCategoryController::class)->names([
        'index' => 'subCategory.index',
        'create' => 'subCategory.create',
        'store' => 'subCategory.store',
        'show' => 'subCategory.show',
        'edit' => 'subCategory.edit',
        'update' => 'subCategory.update',
        'destroy' => 'subCategory.destroy',
    ]);
});
