<?php

namespace App\Http\Controllers\backend;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\MakeSlug;

class SubCategoryController extends Controller
{
    use MakeSlug;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = SubCategory::with('category')->latest()->get();
        $categories = Category::select('id', 'title')->get();

        return view('backend.category.addSubCategory', compact('subcategories', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required'
        ]);

        $subCategory = SubCategory::create([
            "title" => $request->title,
            "slug" => $this->makeSlug("sub_categories", $request->title),
            "category_id" => $request->category_id,
        ]);

        return back(201)->with('success', 'sub category created');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        $editedCategory = $subCategory;
        $subcategories = SubCategory::with('category')->latest()->get();
        $categories = Category::select('id', 'title')->get();

        return view('backend.category.addSubCategory', compact('subcategories', 'categories', 'editedCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $subCategory->title = $request->title;
        $subCategory->slug = $this->makeSlug("sub_categories", $request->title);
        $subCategory->update();
        return back()->with('success', 'sub category updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return back()->with('success', 'sub category deleted');
    }
}
