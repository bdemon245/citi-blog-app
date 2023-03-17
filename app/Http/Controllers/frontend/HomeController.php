<?php

namespace App\Http\Controllers\frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $categories  = Category::with('subcategories')->latest()->get();
        return view('frontend.home', compact('categories'));
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
