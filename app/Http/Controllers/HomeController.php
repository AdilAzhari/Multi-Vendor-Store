<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = product::where('featured', true)->take(8)->get();
        return view('home', compact('featuredProducts'));
    }
    public function contact()
    {
        return view('contact');
    }
}
