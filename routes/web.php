<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

require __DIR__ . '/auth.php';

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

    Route::controller(CategoriesController::class)->prefix('categories')->name('dashboard.categories.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}', 'show')->name('show');
        Route::get('/{category}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });
});
