<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\front\CheckoutController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController as FrontProductController;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

require __DIR__ . '/auth.php';

Route::get('contact', [homeController::class, 'contact'])->name('contact');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::view('profile', 'profile')
        ->name('profile');

    Route::post('/logout', Logout::class)->name('logout');

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });
    // // Front Routes

    Route::get('front/products', [FrontProductController::class, 'index'])->name('front.products.index');
    Route::get('front/products/{product:slug}', [FrontProductController::class, 'show'])->name('front.products.show');

    Route::resource('cart', CartController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/checkout', 'create')->name('checkout');
        Route::post('/checkout', 'store')->name('checkout.store');
        Route::get('/confirmation/{order}', 'confirmation')->name('confirmation');
    });

});

require __DIR__ . '/dashboard.php';
