<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\OrdersController;


// Menampilkan halaman utama website
Route::get('/', [OrdersController::class, 'index']);

// Menampilkan halaman customer dan memberikan nama route customer.index
Route::get('/customer', [OrdersController::class, 'index'])->name('customer.index');

// Menampilkan halaman customer menggunakan route dengan nama customer.index
Route::get('/customer', [OrdersController::class, 'index'])
    ->name('customer.index');

// Memproses pesanan customer setelah melakukan checkout
Route::post('/checkout', [OrdersController::class, 'store'])
    ->name('customer.checkout');

// Menampilkan dashboard admin
Route::get('/dashboard', [OrdersController::class, 'adminDashboard'])
    // Memastikan pengguna sudah login dan akun sudah terverifikasi
    ->middleware(['auth', 'verified'])
    // Memberikan nama route dashboard
    ->name('dashboard');



Route::middleware('auth')->group(function () {

    // Menampilkan halaman edit profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    // Memproses perubahan data profil pengguna
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    // Menghapus akun pengguna
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    // Menampilkan dashboard admin
    Route::get('/admin/dashboard', [OrdersController::class, 'adminDashboard'])
        ->name('admin.dashboard');


    // Mengubah status pesanan
    Route::patch('/admin/orders/{id}/status', [OrdersController::class, 'updateStatus'])
        ->name('admin.orders.updateStatus');


    // Membuat route CRUD untuk data event
    Route::resource('/admin/events', EventsController::class);
});


// Memasukkan route autentikasi seperti login, register, logout, dan reset password
require __DIR__.'/auth.php';