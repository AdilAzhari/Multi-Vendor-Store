<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ImportProductController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\StoresController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


    // // Admin Routes
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('account/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('account/profile', [ProfileController::class, 'update']);

    Route::controller(ProductController::class)->prefix('products')->name('products.')->group(function () {
        Route::get('/trash', 'trash')->name('trash');
        Route::get('/create', 'create')->name('create');
        Route::put('/{id}/restore', 'restore')->name('restore');
        Route::delete('/{id}/forceDelete', 'forceDelete')->name('forceDelete');
    });

    Route::controller(ImportProductController::class)->prefix('products')->name('import-product.')->group(function () {
        Route::get('/import', 'create')->name('create');
        Route::post('/import', 'store')->name('store');
    });

    Route::resource('products', ProductController::class, ['names' => [
        'create' => 'dashboard.products.create' // Custom name for show method
    ]]);

    Route::resources([
        'categories' => CategoriesController::class,
        'products' => ProductController::class,
        // 'stores', StoresController::class,
    ]);

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
});
