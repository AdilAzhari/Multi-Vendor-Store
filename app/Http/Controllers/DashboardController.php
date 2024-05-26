<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        auth()->guard('web')->logout();
        return redirect('/');
    }
}
