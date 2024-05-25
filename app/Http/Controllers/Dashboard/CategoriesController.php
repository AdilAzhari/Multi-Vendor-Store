<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = request();
        $filters = $request->all();
        $categories = Category::Filter($filters)->withCount('products')->latest()->paginate(10);
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::paginate(10);
        return view('dashboard.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $request->parent_id;
        $request->merge([
            'slug' => str::slug($request->name)
        ]);
        Category::create($request->all());
        return redirect()->route('dashboard.categories.index')->with('success', 'Category added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::where('id', '!=', $category->id)->paginate(10);
        return view('dashboard.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $category = Category::findOrFail($id);
        $request->merge([
            'slug' => str::slug($request->name)
        ]);
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $request->image,
            'parent_id' => $request->parent_id,
            'slug' => $request->slug,
        ]);
        return redirect()->route('dashboard.categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('dashboard.categories.index')->with('success', 'Category deleted successfully');
    }

    public function trash(){
        $categories = category::onlyTrashed()->paginate(5);
        return view('dashboard.categories.trash', compact('categories'));
    }
    /**
     * Restore the specified resource from storage.
     */
    public function restore(string $id){
        category::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->route('dashboard.categories.index')->with('success', 'Category restored successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function forceDelete(Category $category){
        $category = $category->onlyTrashed();
        if ($category->image != null) {
            unlink(public_path('uploads/categories/' . $category->image));
        }
        $category->forceDelete();
        return redirect()->route('dashboard.categories.trash')->with('success', 'Category deleted successfully');
    }
}
