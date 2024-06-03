<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\StoresController;
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

    Route::view('dashboard', 'dashboard')
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->name('profile');

    Route::post('/logout', Logout::class)->name('logout');

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('index');
    });

    // Admin Routes

    Route::get('dashboard', [CategoriesController::class, 'index'])->name('dashboard');

    Route::controller(CategoriesController::class)->prefix('categories')->name('categories.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{category}', 'show')->name('show');
        Route::get('/{category}/edit', 'edit')->name('edit');
        Route::put('/{category}', 'update')->name('update');
        Route::delete('/{category}', 'destroy')->name('destroy');

        Route::put('{category}/restore', 'restore')->name('restore');
        Route::put('{category}/forceDelete', 'forceDelete')->name('forceDelete');
        Route::get('{category}/delete', 'delete')->name('delete');
        Route::get('categories/trash', 'trash')->name('trash');
    })->middleware('Login');

    Route::resource('products', ProductController::class, ['names' => [
        'create' => 'dashboard.products.create' // Custom name for show method
    ]]);

    Route::controller(ProductController::class)->prefix('product')->name('products.')->group(function () {
        Route::get('/trash', 'trash')->name('trash');
        Route::get('/create', 'create')->name('create');
        Route::put('products/{id}/restore', 'restore')->name('restore');
        Route::delete('products/{id}/forceDelete', 'forceDelete')->name('forceDelete');
    });

    Route::controller(ProductController::class)->prefix('front/products')->name('front.products.')->group(function () {
        Route::get('/{product}', 'show')->name('show');
    });
    Route::resource('stores', StoresController::class);




    // Front Routes

    Route::resource('/dashboard', DashboardController::class);

    Route::get('index/products', [FrontProductController::class, 'index'])->name('front.products.index');
    Route::get('index/products/{product:slug}', [FrontProductController::class, 'show'])->name('front.products.show');

    Route::resource('cart', CartController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/checkout', 'create')->name('checkout');
        Route::post('/checkout', 'store')->name('checkout.store');
        Route::get('/confirmation/{order}', 'confirmation')->name('confirmation');
    });

});
