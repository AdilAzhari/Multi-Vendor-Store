<?php

namespace App\Http\Controllers\Front\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class twoFactorAuthenticationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('front.auth.two-factor-authentication', compact('user'));
    }
}
