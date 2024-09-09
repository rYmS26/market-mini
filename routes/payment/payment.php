<?php

use App\Http\Controllers\PurchaseController;

// Purchase routes
Route::get('/buy/{id}', [PurchaseController::class, 'buy'])->name('buy.product');
Route::post('/process-payment', [PurchaseController::class, 'processPayment'])->name('process.payment');
Route::get('/payment-success', [PurchaseController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment-failed', [PurchaseController::class, 'paymentFailed'])->name('payment.failed');