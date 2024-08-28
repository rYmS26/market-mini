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
Route::get('profile', [ProfilController::class, 'show'])->name('profile');
Route::post('profile/update', [ProfilController::class, 'update'])->name('profile.update');

Route::get('/product-report', [ProductReportController::class, 'index'])->name('product.report');
Route::get('/product-report/pdf', [ProductReportController::class, 'downloadPDF'])->name('product.report.pdf');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');

// Route to view the product details and initiate purchase
Route::get('/buy/{id}', [PurchaseController::class, 'buy'])->name('buy.product');

// Route to handle payment processing (POST request)
Route::post('/process-payment', [PurchaseController::class, 'processPayment'])->name('process.payment');

// Route to show a success message after payment
Route::get('/payment-success', [PurchaseController::class, 'paymentSuccess'])->name('payment.success');

// Optional route for payment failure handling
Route::get('/payment-failed', [PurchaseController::class, 'paymentFailed'])->name('payment.failed');

// Admin login route
Route::get('admin/login', [AdminLoginController::class, 'login'])->name('admin.adminlogin');

// Admin login action
Route::post('admin/login', [AdminLoginController::class, 'actionadmin'])->name('admin.actionadmin');

// Admin logout route
Route::post('admin/logout', [AdminLoginController::class, 'actionlogout'])->name('admin.actionlogout');

// Admin dashboard route
Route::middleware(['auth:admin'])->group(function () {
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});
