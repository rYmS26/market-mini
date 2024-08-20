<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductReportController;
use App\Http\Controllers\PurchaseController;

// Route utama mengarah ke halaman home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route login
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

// Route home yang dilindungi middleware auth
// Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout');

// Routes for registration
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');

// Google authentication routes
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

// Display products with filter sidebar
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Display form to create a new product
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// Store a new product
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// Display a specific product
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Display form to edit a product
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

// Update a product
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

// Delete a product
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('profile', [ProfileController::class, 'show'])->name('profile');
Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/product-report', [ProductReportController::class, 'index'])->name('product.report');
Route::get('/product-report/pdf', [ProductReportController::class, 'downloadPDF'])->name('product.report.pdf');

Route::get('/buy/{id}', [PurchaseController::class, 'buy'])->name('buy.product');
Route::post('/process-payment', [PurchaseController::class, 'processPayment'])->name('process.payment');
Route::get('/payment-success', [PurchaseController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/midtrans/checkout', [PurchaseController::class, 'midtransCheckout'])->name('midtrans.checkout');
