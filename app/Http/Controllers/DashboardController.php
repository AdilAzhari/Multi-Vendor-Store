<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return view('layouts.dashboard', compact('categories'));
    }
    function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        auth()->guard('web')->logout();
        return redirect('/');
    }
}
