<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\product;
use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['name', 'status', 'store_id']);
        $stores = Store::all();
        $products = product::with('category', 'store')->filter($filters)
            ->latest()->paginate(10);
        return view('dashboard.products.index', compact('products', 'stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $parentCategories  = Category::whereNull('parent_id')->get();
        $stores = Store::all();
        return view('dashboard.products.create', compact('categories', 'parentCategories', 'stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreproductRequest $request)
    {
        $request->merge([
            'slug' => str::slug($request->name)
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->store('products', 'public');
            $request->merge([
                'image' => $image->hashName()
            ]);
        }
        product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        return view('dashboard.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        $categories = Category::all();
        $parentCategories  = Category::whereNull('parent_id')->get();
        $stores = Store::all();
        $product->load('category', 'store');
        return view('dashboard.products.edit', compact('categories', 'parentCategories', 'stores', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateproductRequest $request, product $product)
    {
        $request->merge([
            'slug' => str::slug($request->name)
        ]);
        $product->update($request->validated());
        return redirect()->route('products.index')->with('info', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('Info', 'Product deleted and Trashed successfully');
    }
    public function trash()
    {
        $trashedProducts = product::onlyTrashed()->with('category')->latest()->paginate(10);
        return view('dashboard.products.trash', compact('trashedProducts'));
    }
    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('products.trash')->with('Warning', 'Product restored from trash successfully.');
    }

    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();
        return redirect()->route('products.trash')->with('Danger', 'Product permanently deleted.');
    }
}
