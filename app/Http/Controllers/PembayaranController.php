<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function tampil(Pesanan $pesanan)
    {
        abort_unless((int) $pesanan->id_pelanggan === (int) Auth::guard('pelanggan')->id(), 404);

        $pesanan->load(['detail.produk', 'pembayaran', 'pengiriman']);

        return view('pembayaran.tampil', compact('pesanan'));
    }
}