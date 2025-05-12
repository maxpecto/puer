<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [WelcomeController::class, 'index'])->name('home');

// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

// Contact Page Route
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact-us/submit', [ContactController::class, 'submit'])->name('contact.submit');

// Offer Routes
Route::get('/offers/{offer:slug}', [OfferController::class, 'show'])->name('offer.show');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout Route
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

// About Us Page Route
Route::get('/about-us', [PageController::class, 'about'])->name('about.index');

// Fallback Route for Filament assets, if needed (usually handled by Filament itself)
// Route::get('{path?}', function ($path) {
// return response()->file(public_path($path));
// })->where('path', '.*\.(css|js|png|jpg|jpeg|gif|svg|woff|woff2|ttf|eot|ico|map)$');

Route::middleware([
    'auth:sanctum',
    // ... existing code ...
])->group(function () {
    // ... existing code ...
});
