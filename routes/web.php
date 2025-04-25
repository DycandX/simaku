<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Login Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Route - Dilindungi middleware
Route::middleware(['check.login'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});



Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/tagihan-ukt', [TagihanController::class, 'index'])->name('tagihan.ukt');
Route::get('/daftar-utang', [TagihanController::class, 'daftarUtang'])->name('daftar.utang');
Route::get('/beasiswa', [BeasiswaController::class, 'index'])->name('beasiswa');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/settings', [SettingController::class, 'index'])->name('settings');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');