<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderEvent;
use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $products = product::with('category')->active()
            ->latest()
            ->take(8)
            ->get();

        return view('dashboard.categories.index', compact('products'));

    }
}
