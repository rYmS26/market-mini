<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\DashboardAdminController; // Tambahkan Controller ini
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserDetailController;

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

    Route::get('/admin/userdetails', [UserDetailController::class, 'index'])->name('admin.userdetail.index');
});
