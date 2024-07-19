<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
class LocaleController extends Controller
{
    public function setLocale($locale)
    {
        if (array_key_exists($locale, LaravelLocalization::getSupportedLocales())) {
            LaravelLocalization::setLocale($locale);
            session(['locale' => $locale]);
        }
        return redirect()->back();
    }
}
