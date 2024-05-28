<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //product list
    public function index()
    {
        // return view('front.product.index');
    }

    //product detail
    public function show(product $product)
    {
        // dd($product->name);
        if(!$product->active()){
            abort(404);
        }
        return view('front.product.show',compact('product'));
    }
}
