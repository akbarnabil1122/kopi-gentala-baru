<?php

use App\Http\Controllers\KatalogController;
use Illuminate\Support\Facades\Route;

Route::get('/', [KatalogController::class, 'beranda'])->name('beranda');