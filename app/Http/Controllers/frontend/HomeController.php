<?php

namespace App\Http\Controllers\frontend;

use App\Models\Post;
use Spatie\Tags\Tag;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->ip());
        $categories  = Category::with(['subcategories'])->latest()->get();
        $banners = Post::with(['category', 'subCategory', 'user'])->where('is_banner', '>', "0")->latest()->get();
        $tags = Tag::get();
        $posts = Post::with('category', 'subCategory', 'user', 'comments', 'comments.replies', 'comments.replies.user', 'comments.user')->latest()->paginate(6);

        return view('frontend.home', compact('categories', 'banners', 'posts', 'tags'));
    }

    public function showCategoryPost($id)
    {
        $category  = Category::find($id);
        $tags = Tag::get();
        $posts = Post::with('category', 'subCategory', 'user')->where('category_id', $category->id)->paginate(6);
        return view('frontend.categoryShow', compact('category', 'posts', 'tags'));
    }
    public function showTagPost(Tag $tag)
    {
        $posts = Post::with('category', 'subCategory', 'user')->withAnyTags([$tag->slug])->paginate(6);
        return view('frontend.tagsShow', compact('tag', 'posts'));
    }

    public function showSubCategoryPost($id)
    {
        $category  = SubCategory::find($id);
        $tags = Tag::get();
        $posts = Post::with('category', 'subCategory', 'user')->where('category_id', $category->id)->paginate(6);
        return view('frontend.categoryShow', compact('category', 'posts', 'tags'));
    }

    public function searchLive(Request $request)
    {
        $posts = Post::with('user', 'category', 'subCategory')->where('title', 'LIKE', "%$request->search%")->get();
        return response(json_encode($posts));
    }
    public function showPost(Post $post)
    {
        $post = Post::where('id', $post->id)->with('user', 'tags', 'comments', 'comments.replies', 'comments.replies.user', 'comments.user')->first();
        $tags = Tag::get();
        // dd($post);
        return view('frontend.singleBlog', compact('post', 'tags'));
    }

    public function incrementViewCount(Request $request, $id)
    {
        $post = Post::find($id);

        $post->view_count += 1;
        $post->save();
        return response()->json([
            'success' => true,
            'view_count' => $post->view_count
        ]);
    }
}
