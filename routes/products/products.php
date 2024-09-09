<?php

use App\Http\Controllers\ProductUserController;

Route::get('/products', [ProductUserController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductUserController::class, 'create'])->name('products.create');
Route::post('/products', [ProductUserController::class, 'store'])->name('products.store');
Route::get('/products/{id}', [ProductUserController::class, 'show'])->name('products.show');
Route::get('/products/{id}/edit', [ProductUserController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductUserController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductUserController::class, 'destroy'])->name('products.destroy');