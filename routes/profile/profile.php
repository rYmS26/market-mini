<?php

use App\Http\Controllers\ProfilController;

// Profil routes
Route::get('profile', [ProfilController::class, 'show'])->name('profile');
Route::post('profile/update', [ProfilController::class, 'update'])->name('profile.update');