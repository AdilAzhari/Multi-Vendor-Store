<?php

use App\Http\Controllers\Api\AccessTokensController;
use App\Http\Controllers\Api\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return 'Hello World';
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::apiResource('products', ProductsController::class)->middleware('auth:sanctum')->except('index', 'show');
    Route::post('login', [AccessTokensController::class, 'store'])->middleware('guest:sanctum');
    Route::middleware('auth:sanctum')->group(function () {
        Route::controller(AccessTokensController::class)->group(function () {
            // Route::post('logout','destroy');
            Route::delete('/auth/access-tokens/{token}', 'destroy');
        });
    });
});
