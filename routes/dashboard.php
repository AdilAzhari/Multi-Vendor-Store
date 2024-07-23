<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\StoresController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


    // // Admin Routes
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('account/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('account/profile', [ProfileController::class, 'update']);

    Route::resource('products', ProductController::class, ['names' => [
        'create' => 'dashboard.products.create' // Custom name for show method
    ]]);

    Route::controller(ProductController::class)->prefix('product')->name('products.')->group(function () {
        Route::get('/trash', 'trash')->name('trash');
        Route::get('/create', 'create')->name('create');
        Route::put('products/{id}/restore', 'restore')->name('restore');
        Route::delete('products/{id}/forceDelete', 'forceDelete')->name('forceDelete');
    });

    // Route::controller(ProductController::class)->prefix('front/products')->name('front.products.')->group(function () {
    //     Route::get('/{product}', 'show')->name('show');
    // });

    Route::resource('stores', StoresController::class);

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

    Route::resource('categories', CategoriesController::class);
});
