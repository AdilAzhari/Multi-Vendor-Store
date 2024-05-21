<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
    Route::post('/logout', Logout::class)->name('logout');

require __DIR__.'/auth.php';

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('index');
})->middleware(['auth', 'verified']);

Route::resource('/dashboard',DashboardController::class);
Route::get('users', [CategoriesController::class, 'index'])->name('user.index');

Route::controller(CategoriesController::class)->prefix('categories')->name('dashboard.categories.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show');
    Route::get('/{id}/edit', 'edit')->name('edit');
    Route::put('/{id}', 'update')->name('update');
    Route::delete('/{id}', 'destroy')->name('destroy');

})->middleware(['auth', 'verified']);
