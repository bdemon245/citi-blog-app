<?php

namespace App\Providers;

use App\Models\Post;
use Spatie\Tags\Tag;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (!$this->app->environment('production')) {
            $this->app->register('App\Providers\FakerServiceProvider');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.custom');
        Paginator::defaultSimpleView('vendor.pagination.simple-tailwind');

        // Using view composer to set following variables globally
        view()->composer('*', function ($view) {
            $view->with('categories', Category::with('subCategories')->get());
            $view->with('subCategories', SubCategory::with('category')->get());
            $view->with('tags', Tag::get());
            $view->with("popularPosts", Post::with('category', 'subCategory', 'user')->orderBy('view_count', 'asc')->paginate(5));
        });
    }
}
