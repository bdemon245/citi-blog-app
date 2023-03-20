<?php

namespace App\Http\Controllers\frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $categories  = Category::with('subcategories')->latest()->get();
        $banners = Post::with('category', 'subCategory', 'user')->where('is_banner', '>', "0")->latest()->get();
        $posts = Post::with('category', 'subCategory', 'user')->latest()->paginate(5);

        return view('frontend.home', compact('categories', 'banners', 'posts'));
    }

    public function showCategoryPost($id)
    {
        return view('frontend.categoryShow');
    }

    public function showSubCategoryPost($id)
    {
        return view('frontend.categoryShow');
    }

    public function searchLive()
    {
        # code...
    }
    public function showPost()
    {
        # code...
    }
}
