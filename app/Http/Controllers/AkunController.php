<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AkunController extends Controller
{
    private const STATUS_BERJALAN = ['Pesanan Masuk', 'Diproses', 'Dikemas', 'Dikirim', 'Diantar'];

    public function index(Request $request)
    {
        $tab = $request->query('tab') === 'riwayat' ? 'riwayat' : 'pesanan';
        $pelanggan = Auth::guard('pelanggan')->user();
        $daftar = collect();

        if ($pelanggan) {
            $query = Pesanan::with(['detail.produk', 'pembayaran', 'pengiriman'])
                ->where('id_pelanggan', $pelanggan->id_pelanggan);

            if ($tab === 'pesanan') {
                $query->whereIn('status_pesanan', self::STATUS_BERJALAN);
            } else {
                $query->whereNotIn('status_pesanan', self::STATUS_BERJALAN);
            }

            $daftar = $query->orderByDesc('tanggal_pesanan')->get();
        }

        return view('akun.index', compact('pelanggan', 'daftar', 'tab'));
    }
}