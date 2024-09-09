<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Route utama mengarah ke halaman home
Route::get('/', [HomeController::class, 'index'])->name('home');

require __DIR__.'/admin/admin.php';
require __DIR__.'/products/products.php';
require __DIR__.'/cart/cart.php';
require __DIR__.'/login/login.php';
require __DIR__.'/register/register.php';
require __DIR__.'/googlelogin/google.php';
require __DIR__.'/profile/profile.php';
require __DIR__.'/report/report.php';
require __DIR__.'/payment/payment.php';
