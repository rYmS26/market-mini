<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserDetailController;
use App\Http\Controllers\Admin\TransactionController;

Route::get('admin/login', [AdminLoginController::class, 'login'])->name('admin.adminlogin');
Route::post('admin/login', [AdminLoginController::class, 'actionadmin'])->name('admin.actionadmin');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('admin/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    
    // Product Management by Admin
    Route::get('admin/products', [ProductController::class, 'adminIndex'])->name('admin.products.index');
    Route::get('admin/products/create', [ProductController::class, 'adminCreate'])->name('admin.products.create');
    Route::get('admin/transactions', [TransactionController::class, 'index'])->name('admin.infotransaction');
    Route::get('/admin/userdetails', [UserDetailController::class, 'index'])->name('admin.userdetail.index');
    Route::get('admin/products/{id}', [ProductController::class, 'adminShow'])->name('admin.products.show');
    Route::get('admin/products/{id}/edit', [ProductController::class, 'adminEdit'])->name('admin.products.edit');
    Route::put('admin/products/{id}', [ProductController::class, 'adminUpdate'])->name('admin.products.update');
    Route::post('admin/logout', [AdminLoginController::class, 'actionlogout'])->name('admin.actionlogout');
    Route::post('admin/products', [ProductController::class, 'adminStore'])->name('admin.products.store');
    Route::delete('admin/products/{id}', [ProductController::class, 'adminDestroy'])->name('admin.products.destroy');
});