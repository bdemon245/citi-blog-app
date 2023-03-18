<?php

namespace App\Http\Controllers\backend;

use App\Models\Post;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Traits\MakeSlug;

class PostController extends Controller
{
    use MakeSlug;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category', 'subCategory')->paginate(10);

        return view('backend.post.allPost', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        $subCategories = SubCategory::get();
        return view('backend.post.addPost', compact('categories', 'subCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $slug = $this->makeSlug('posts', $request->title);
        $ext = $request->featured_img->extension();
        $fileName = "$slug.$ext";
        $path = $request->featured_img->storeAs('uploads/posts', $fileName, 'public');

        $post = Post::create([
            'title' => $request->title,
            'slug' => $slug,
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'type' => $request->type,
            'content' => $request->content,
            'featured_img' => $path,
        ]);

        return back(201)->with('success', 'new post created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {

        return view('backend.post.showPost', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'post deleted');
    }
}
