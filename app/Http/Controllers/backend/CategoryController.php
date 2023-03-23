<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\MakeSlug;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    use MakeSlug;

    public function __construct()
    {
        $this->middleware('permission:read category', [
            'only' => ['index', 'show']
        ]);
        $this->middleware('permission:create category',   [
            'only' => ['create', 'store']
        ]);
        $this->middleware('permission:update category',   [
            'only' => ['update', 'edit']
        ]);
        $this->middleware('permission:delete category',  [
            'only' => ['destroy']
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('backend.category.addCategory', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
        ],);


        $category = Category::create([
            'title' => $request->title,
            'slug' => $this->makeSlug('categories', $request->title),
        ]);
        return back()->with('success', 'new category added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $editedCategory = $category;
        $categories  = Category::latest()->get();
        return view('backend.category.addCategory', compact('categories', 'editedCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate(
            ["title" => "required"]
        );
        $category->title = $request->title;
        $category->slug = $this->makeSlug('categories', $request->title);
        $category->update();
        return redirect()->route('category.index')->with('success', 'category updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'category deleted');
    }


    // private function slugGenerator($title, $slug = null)
    // {

    //     if ($slug == null) {
    //         $newSlug  = str()->slug($title);
    //     } else {
    //         $newSlug = str()->slug($slug);
    //     }
    //     $count  = Category::where('slug', 'LIKE', '%' . $newSlug . '%')->count();
    //     if ($count > 0) {
    //         $newSlug = $newSlug . '-' . $count++;
    //     }

    //     return $newSlug;
    // }
}
