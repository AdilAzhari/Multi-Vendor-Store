<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\StoresController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoreController;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');
Route::get('/', [HomeController::class, 'index'])->name('home');

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

    Route::resource('/dashboard', DashboardController::class);

    Route::get('dashboard', [CategoriesController::class, 'index'])->name('dashboard');
    // Route::get('dashboards', CategoriesList::class)->name('dashboards');

    Route::controller(CategoriesController::class)->prefix('categories')->name('dashboard.categories.')->group(function () {
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
    });
    Route::resource('products', ProductController::class, ['names' => [
        'create' => 'dashboard.products.create' // Custom name for show method
    ]]);
    Route::controller(ProductController::class)->prefix('product')->name('products.')->group(function () {
        Route::get('/trash', 'trash')->name('trash');
        Route::get('/create', 'create')->name('create');

        Route::put('products/{id}/restore', 'restore')->name('restore');
        Route::delete('products/{id}/forceDelete', 'forceDelete')->name('forceDelete');
        // Route::post('/orde/srs', 'store');
    });
    Route::controller(ProductController::class)->prefix('front/products')->name('front.products.')->group(function () {
        Route::get('/{product}', 'show')->name('show');
        // Route::post('/orders', 'store');
    });
    Route::resource('stores', StoresController::class);
});
