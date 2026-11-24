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

    public function index()
    {
        $produk = Produk::where('status_aktif', true)
            ->orderBy('id_produk')
            ->get();

        return view('katalog.index', compact('produk'));
    }

    public function detail(Produk $produk)
    {
        abort_unless($produk->status_aktif, 404);

        return view('katalog.detail', compact('produk'));
    }
}