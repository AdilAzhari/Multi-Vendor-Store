<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreProductRequest;
use App\Models\product;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ProductsController extends Controller
{
    use ApiResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        $filters = $request->all();
        // $prodcuts = product::filter($filters)->paginate(10);
        $prodcut = product::with('category')->filter($filters)->
        active()->latest()->paginate(10);
        return $this->successResponse($prodcut, 'Products Fetched Successfully', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->only([
            'name', 'slug', 'description', 'price', 'category_id', 'store_id', 'status'
        ]));
        return $this->successResponse($product, 'Product Created Successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
