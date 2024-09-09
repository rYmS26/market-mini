<?php

use App\Http\Controllers\ProductReportController;

// Product Report routes
Route::get('/product-report', [ProductReportController::class, 'index'])->name('product.report');
Route::get('/product-report/pdf', [ProductReportController::class, 'downloadPDF'])->name('product.report.pdf');