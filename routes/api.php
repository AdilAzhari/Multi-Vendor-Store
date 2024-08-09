<?php

use App\Http\Controllers\Api\AccessTokensController;
use App\Http\Controllers\Api\DeliveriesController;
use App\Http\Controllers\Api\ProductsController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('products', ProductsController::class)->middleware('auth:sanctum')->except('index', 'show');
    Route::post('login', [AccessTokensController::class, 'store'])->middleware('guest:sanctum');
    Route::middleware('auth:sanctum')->group(function () {
        Route::controller(AccessTokensController::class)->group(function () {
            Route::delete('/auth/access-tokens/{token}', 'destroy');
        });
    });
    Route::controller(DeliveriesController::class)->prefix('deliveries/{delivery}')->name('deliveries.')->group(function () {
        Route::put('/', 'update')->name('update');
        Route::get('/', 'show')->name('show');
    });
});
