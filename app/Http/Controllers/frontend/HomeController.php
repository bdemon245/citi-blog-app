<?php

namespace App\Http\Controllers\frontend;

use App\Models\Post;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $categories  = Category::with(['subcategories'])->latest()->get();
        $banners = Post::with(['category', 'subCategory', 'user'])->where('is_banner', '>', "0")->latest()->get();

        $posts = Post::with('category', 'subCategory', 'user')->latest()->paginate(5);

        return view('frontend.home', compact('categories', 'banners', 'posts'));
    }

    public function showCategoryPost($id)
    {
        $category  = Category::find($id);
        $posts = Post::with('category', 'subCategory', 'user')->where('category_id', $category->id)->paginate(6);
        return view('frontend.categoryShow', compact('category', 'posts'));
    }

    public function showSubCategoryPost($id)
    {
        $category  = SubCategory::find($id);
        $posts = Post::with('category', 'subCategory', 'user')->where('category_id', $category->id)->paginate(6);
        return view('frontend.categoryShow', compact('category', 'posts'));
    }

    public function searchLive(Request $request)
    {
        $posts = Post::with('user', 'category', 'subCategory')->where('title', 'LIKE', "%$request->search%")->get();
        return response(json_encode($posts));
    }
    public function showPost(Post $post)
    {
        $post = Post::where('id', $post->id)->with('user', 'comments', 'comments.replies', 'comments.replies.user', 'comments.user')->first();
        // dd($post);
        return view('frontend.singleBlog', compact('post'));
    }

    public function incrementViewCount($id)
    {
        $post = Post::find($id);
        $post->view_count += 1;
        return response()->json([
            'success' => true,
            'view_count' => $post->view_count
        ]);
    }
}
