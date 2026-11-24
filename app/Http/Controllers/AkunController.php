<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AkunController extends Controller
{
    /**
     * Status pesanan yang masih berjalan.
     */
    private const STATUS_BERJALAN = [
        'Pesanan Masuk',
        'Diproses',
        'Dikemas',
        'Dikirim',
        'Diantar',
    ];

    /**
     * Menampilkan halaman akun dan daftar pesanan pelanggan.
     */
    public function index(Request $request)
    {
        // Menentukan tab yang sedang dibuka.
        $tab = $request->query('tab') === 'riwayat'
            ? 'riwayat'
            : 'pesanan';

        // Mengambil pelanggan yang sedang login.
        $pelanggan = Auth::guard('pelanggan')->user();

        $daftar = collect();

        if ($pelanggan) {

            // Mengambil pesanan beserta seluruh relasinya.
            $query = Pesanan::with([
                'detail.produk',
                'pembayaran',
                'pengiriman',
            ])->where(
                'id_pelanggan',
                $pelanggan->id_pelanggan
            );

            // Memisahkan pesanan berjalan dan riwayat.
            if ($tab === 'pesanan') {
                $query->whereIn(
                    'status_pesanan',
                    self::STATUS_BERJALAN
                );
            } else {
                $query->whereNotIn(
                    'status_pesanan',
                    self::STATUS_BERJALAN
                );
            }

            // Mengurutkan pesanan terbaru.
            $daftar = $query
                ->orderByDesc('tanggal_pesanan')
                ->get();
        }

        return view('akun.index', compact(
            'pelanggan',
            'daftar',
            'tab'
        ));
    }
}
