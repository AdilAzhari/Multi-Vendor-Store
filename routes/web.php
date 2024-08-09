<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\front\CheckoutController;
use App\Http\Controllers\Front\CurrencyConverterController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\LocaleController;
use App\Http\Controllers\Front\OrdersController;
use App\Http\Controllers\Front\PaymentController;
use App\Http\Controllers\Front\ProductController as FrontProductController;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', [HomeController::class,'index'])->name('home');

require __DIR__ . '/auth.php';

// Route::get('contact', [homeController::class, 'contact'])->name('contact');
Route::get('/pages/{name}', [HomeController::class, 'show'])
    ->name('pages');

Route::prefix(LaravelLocalization::setLocale())->middleware(['auth', 'verified','localeSessionRedirect', 'localizationRedirect','localeViewPath'])
    ->group(function () {

    Route::view('profile', 'profile')
        ->name('profile');

    Route::post('/logout', Logout::class)->name('logout');

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });
    // // Front Routes
    Route::controller(FrontProductController::class)->prefix('front/products')->name('front.products.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{product:slug}', 'show')->name('show');
    });

    Route::resource('cart', CartController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/checkout', 'create')->name('checkout');
        Route::post('/checkout', 'store')->name('checkout.store');
        Route::get('/confirmation/{order}', 'confirmation')->name('confirmation');
    });
    Route::post('currency', [CurrencyConverterController::class, 'store'])->name('currency.store');
});

require __DIR__ . '/dashboard.php';

// routes/web.php

Route::get('setlocale/{locale}', [LocaleController::class, 'setLocale'])->name('setlocale');

// Strip Payment Routes
Route::controller(PaymentController::class)->group(function () {
    Route::get('/orders/{order}/pay', 'create')->name('orders.payments.create');
    Route::post('/orders/{order}/stripe/payment-intent', 'createStripePaymentIntent')->name('stripe.paymentIntent.create');
    Route::get('/orders/{order}/pay/stripe/callback', 'confirmPayment')->name('stripe.return');
});

Route::get('/orders/{order}', [OrdersController::class, 'show'])->name('orders.show');
