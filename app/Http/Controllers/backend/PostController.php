<?php

namespace App\Http\Controllers\backend;

use App\Models\Post;
use App\Models\Category;
use App\Traits\MakeSlug;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    use MakeSlug;

    public function __construct()
    {
        $this->middleware('permission:read post', [
            'only' => ['index', 'show']
        ]);
        $this->middleware('permission:create post',   [
            'only' => ['create', 'store']
        ]);
        $this->middleware('permission:update post',   [
            'only' => ['update', 'edit']
        ]);
        $this->middleware('permission:delete post',  [
            'only' => ['destroy']
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = [];
        if (!auth()->user()->hasRole(['super admin', 'admin', 'editor'])) {
            $query[] = ['user_id', '=', auth()->id()];
        }
        $posts = Post::with('category', 'subCategory', 'user')->where($query)->orderBy('is_banner', 'desc')->paginate(10);

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
        // dd($path);

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
        $categories = Category::get();
        $subCategories = SubCategory::get();
        return view('backend.post.editPost', compact('post', 'categories', 'subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $path = $post->featured_img;
        $slug = $this->makeSlug('posts', $request->title);
        if ($request->featured_img) {
            $ext = $request->featured_img->extension();
            $fileName = "$slug.$ext";
            $path = $request->featured_img->storeAs('uploads/posts', $fileName, 'public');
        }
        $post->update([
            'title' => $request->title,
            'slug' => $slug,
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'type' => $request->type,
            'content' => $request->content,
            'featured_img' => $path,
        ]);
        return redirect()->route('post.index')->with('success', 'post updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $file_path = storage_path('app/public/' . $post->featured_img);
        if (File::exists($file_path)) {
            File::delete($file_path);
        }
        $post->delete();
        return back()->with('success', 'post deleted');
    }
    /**
     * Toggles banner status
     */
    public function toggleBanner(Post $post)
    {
        if ($post->is_banner === 0) {
            $post->is_banner = 1;
            $msg = 'banner activated';
        } else {
            $post->is_banner = 0;
            $msg = 'banner deactivated';
        }
        $post->update();
        return back()->with('success', 'banner activated');
    }
}
