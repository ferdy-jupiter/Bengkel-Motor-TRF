<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\MekanikController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\SparepartController;
use Illuminate\Support\Facades\Route;

// Halaman depan (landing page publik)
Route::get('/', function () {
    return view('landing');
})->name('landing');

// ==================== GUEST (belum login) ====================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ==================== CUSTOMER (harus login) ====================
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'customer'])->name('dashboard');

    Route::resource('motors', MotorController::class)->except(['show']);

    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings/{booking}/invoice', [BookingController::class, 'invoice'])->name('bookings.invoice');
});

// ==================== ADMIN (harus login + role admin) ====================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

    Route::resource('layanans', LayananController::class)->except(['show']);
    Route::resource('mekaniks', MekanikController::class)->except(['show']);
    Route::resource('spareparts', SparepartController::class)->except(['show']);

    Route::get('/bookings', [BookingController::class, 'adminIndex'])->name('bookings.index');
    Route::get('/bookings/{booking}/edit', [BookingController::class, 'adminEdit'])->name('bookings.edit');
    Route::put('/bookings/{booking}', [BookingController::class, 'adminUpdate'])->name('bookings.update');
    Route::post('/bookings/{booking}/sparepart', [BookingController::class, 'addSparepart'])->name('bookings.sparepart.add');
    Route::delete('/bookings/{booking}/sparepart/{sparepart}', [BookingController::class, 'removeSparepart'])->name('bookings.sparepart.remove');
});
