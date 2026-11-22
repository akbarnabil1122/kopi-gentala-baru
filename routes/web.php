<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PembayaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', [KatalogController::class, 'beranda'])->name('beranda');
Route::get('/produk', [KatalogController::class, 'index'])->name('produk.index');
Route::get('/produk/{produk}', [KatalogController::class, 'detail'])->name('produk.detail');
Route::get('/akun', [AkunController::class, 'index'])->name('akun');

Route::middleware('guest:pelanggan')->group(function () {
    Route::get('/daftar', [AuthController::class, 'formDaftar'])->name('daftar');
    Route::post('/daftar', [AuthController::class, 'daftar']);
    Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:pelanggan')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::patch('/keranjang/{keranjang}', [KeranjangController::class, 'ubah'])->name('keranjang.ubah');
    Route::delete('/keranjang/{keranjang}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');

    Route::get('/checkout', [CheckoutController::class, 'form'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'simpan'])->name('checkout.simpan');

    Route::get('/pembayaran/{pesanan}', [PembayaranController::class, 'tampil'])->name('pembayaran.tampil');
});