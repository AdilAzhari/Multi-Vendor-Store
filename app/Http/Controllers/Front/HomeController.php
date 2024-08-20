<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {

        $products = product::with('category')->active()
            ->latest()
            ->take(8)
            ->get();

        $slides = [
            [
                'image' => 'https://via.placeholder.com/800x500',
                'title' => '<span>No restocking fee ($35 savings)</span> M75 Sport Watch',
                'desc' => 'Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.',
                'price' => '320.99',
                'link' => '#',
            ],
            [
                'image' => 'https://via.placeholder.com/800x500',
                'title' => '<span>Big Offer</span> Get the Best Deal on Camera',
                'desc' => 'Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.',
                'price' => '100.59',
                'link' => '#',
            ],
        ];

        $categories = Category::orderBy('name')
            ->with('children') // Eager load
            ->whereNull('parent_id')
            ->get();

        return view('front.home', compact('categories', 'slides', 'products'));

    }
    public function show($slug)
    {
        if ( !View()->exists("front.pages.$slug") ) {
            abort(404);
        }

        return view("front.pages.$slug");
    }
}
