<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class KatalogController extends Controller
{
    public function beranda()
    {
        $produk = Produk::where('status_aktif', true)
            ->orderBy('id_produk')
            ->take(6)
            ->get();

        return view('beranda', compact('produk'));
    }
}