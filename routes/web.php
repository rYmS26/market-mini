<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProductReportController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\DashboardAdminController; // Tambahkan Controller ini

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
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

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

// Admin routes
Route::get('admin/login', [AdminLoginController::class, 'login'])->name('admin.adminlogin');
Route::post('admin/login', [AdminLoginController::class, 'actionadmin'])->name('admin.actionadmin');
Route::post('admin/logout', [AdminLoginController::class, 'actionlogout'])->name('admin.actionlogout');

// Routes under auth:admin middleware
Route::middleware(['auth:admin'])->group(function () {
    Route::get('admin/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    
    // Product Management by Admin
    Route::get('admin/products', [ProductController::class, 'adminIndex'])->name('admin.products.index');
    Route::get('admin/products/create', [ProductController::class, 'adminCreate'])->name('admin.products.create');
    Route::post('admin/products', [ProductController::class, 'adminStore'])->name('admin.products.store');
    Route::get('admin/products/{id}', [ProductController::class, 'adminShow'])->name('admin.products.show');
    Route::get('admin/products/{id}/edit', [ProductController::class, 'adminEdit'])->name('admin.products.edit');
    Route::put('admin/products/{id}', [ProductController::class, 'adminUpdate'])->name('admin.products.update');
    Route::delete('admin/products/{id}', [ProductController::class, 'adminDestroy'])->name('admin.products.destroy');
});
