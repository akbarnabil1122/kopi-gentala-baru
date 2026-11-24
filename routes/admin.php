
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminPesananController;

// LOGIN ADMIN
Route::get('/login', [AdminAuthController::class, 'formLogin'])
    ->name('login');

Route::post('/login', [AdminAuthController::class, 'login'])
    ->name('login.submit');

// VERIFIKASI MFA
Route::post('/verifikasi-mfa', [AdminAuthController::class, 'verifyMFA'])
    ->name('mfa.verify');

// DASHBOARD ADMIN
Route::get('/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware('auth:admin')
    ->name('dashboard');


// MANAJEMEN PRODUK ADMIN
Route::get('/produk', [AdminProdukController::class, 'index'])
    ->middleware('auth:admin')
    ->name('produk.index');

Route::post('/produk', [AdminProdukController::class, 'store'])
    ->middleware('auth:admin')
    ->name('produk.store');

Route::put('/produk/{produk}', [AdminProdukController::class, 'update'])
    ->middleware('auth:admin')
    ->name('produk.update');

Route::delete('/produk/{produk}', [AdminProdukController::class, 'destroy'])
    ->middleware('auth:admin')
    ->name('produk.destroy');

Route::get('/produk/laporan-stok', [AdminProdukController::class, 'exportStok'])
    ->middleware('auth:admin')
    ->name('produk.export');

// MANAJEMEN PESANAN ADMIN
Route::get('/pesanan', [AdminPesananController::class, 'index'])
    ->name('pesanan.index');

Route::put('/pesanan/{id}/status', [AdminPesananController::class, 'update'])
    ->name('pesanan.update-status');


// LOGOUT ADMIN
Route::post('/logout', function () {
    Auth::guard('admin')->logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('admin.login');
})->middleware('auth:admin')->name('logout');