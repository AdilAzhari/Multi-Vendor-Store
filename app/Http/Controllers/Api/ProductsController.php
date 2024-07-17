<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreProductRequest;
use App\Http\Requests\Api\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\product;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
class ProductsController extends Controller
{
    use ApiResponses;
    public function index()
    {
        $filters = request()->only(['category_id', 'store_id', 'price', 'name']);
        $prodcut = product::with('category')->filter($filters)->active()->latest()->paginate(10);
        return $this->successResponse(ProductResource::collection($prodcut), 'Products Retrieved Successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::Create($request->only([
            'name', 'slug', 'description', 'price', 'category_id', 'status', 'store_id', 'status',
        ]));
        $user = auth()->user();
        if(!$user->can('products.create')) return $this->errorResponse('Unauthorized', 403);
        return $this->successResponse(new ProductResource($product), 'Product Created Successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        $product->load('category', 'store');
        return $this->successResponse(new ProductResource($product), 'Product Retrieved Successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, product $product)
    {
        $product->update($request->only([
            'name', 'description', 'price', 'category_id', 'status', 'store_id', 'compare_price',
        ]));
        return $this->successResponse(new ProductResource($product), 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        $user = auth()->guard('sanctum')->user();
        if(!$user->can('products.delete')) return $this->errorResponse('Not Allowed', 403);
        $product->delete();
        return $this->destroyResponse('Product Deleted Successfully', 204);
    }
}
