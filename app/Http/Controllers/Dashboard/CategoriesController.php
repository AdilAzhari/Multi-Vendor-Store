<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\ImageService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
class CategoriesController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::filter($request->all())
                ->withCount('products')
                ->latest()
                ->paginate(10);
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
            'slug' => str()->slug($request->name)
        ]);
        Category::create($request->all());
        return to_route('categories.index')->with('success', 'Category added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show', compact('category'));
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
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $data['slug'] = Str()->slug($data['name']);

        if ($request->hasFile('image')) {
            $data['image'] = $this->imageService->store($request->file('image'), 'categories');
        }

        $category->update($data);

        return to_route('categories.index')->with('info', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return to_route('categories.index')->with('Info', 'Category deleted and Trashed successfully');
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
        return to_route('categories.index')->with('Warning', 'Category restored from trash successfully.');
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
        return to_route('categories.trash')->with('Danger', 'Category permanently deleted.');
    }
}
