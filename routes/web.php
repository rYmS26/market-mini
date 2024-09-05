<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProductUserController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProductReportController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CartController;

// Route utama mengarah ke halaman home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route login
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout');

// Routes for registration
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');

// Google authentication routes
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

// Display products with filter sidebar
Route::get('/products', [ProductUserController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductUserController::class, 'create'])->name('products.create');
Route::post('/products', [ProductUserController::class, 'store'])->name('products.store');
Route::get('/products/{id}', [ProductUserController::class, 'show'])->name('products.show');
Route::get('/products/{id}/edit', [ProductUserController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductUserController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductUserController::class, 'destroy'])->name('products.destroy');

// Profil routes
Route::get('profile', [ProfilController::class, 'show'])->name('profile');
Route::post('profile/update', [ProfilController::class, 'update'])->name('profile.update');

// Product Report routes
Route::get('/product-report', [ProductReportController::class, 'index'])->name('product.report');
Route::get('/product-report/pdf', [ProductReportController::class, 'downloadPDF'])->name('product.report.pdf');

// Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');

// Purchase routes
Route::get('/buy/{id}', [PurchaseController::class, 'buy'])->name('buy.product');
Route::post('/process-payment', [PurchaseController::class, 'processPayment'])->name('process.payment');
Route::get('/payment-success', [PurchaseController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment-failed', [PurchaseController::class, 'paymentFailed'])->name('payment.failed');

require __DIR__.'/admin/admin.php';
