<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Periode bulan berjalan
        $awalBulan = now()->startOfMonth();
        $akhirBulan = now()->endOfMonth();

        // Jumlah pesanan baru
        $jumlahPesananMasuk = Pesanan::where(
            'status_pesanan',
            'Pesanan Masuk'
        )->count();

        // Penjualan bulan ini (tidak termasuk pesanan dibatalkan)
        $penjualanBulanIni = Pesanan::whereBetween(
            'tanggal_pesanan',
            [$awalBulan, $akhirBulan]
        )
        ->where('status_pesanan', '!=', 'Dibatalkan')
        ->sum('total_harga');

        // Jumlah produk terjual bulan ini
        $produkTerjual = DetailPesanan::whereHas(
            'pesanan',
            function ($query) use ($awalBulan, $akhirBulan) {
                $query->whereBetween(
                    'tanggal_pesanan',
                    [$awalBulan, $akhirBulan]
                )->where('status_pesanan', '!=', 'Dibatalkan');
            }
        )->sum('jumlah');

        // Estimasi profit produk bulan ini
        $profitBulanan = DB::table('detail_pesanan')
            ->join(
                'pesanan',
                'detail_pesanan.id_pesanan',
                '=',
                'pesanan.id_pesanan'
            )
            ->join(
                'produk',
                'detail_pesanan.id_produk',
                '=',
                'produk.id_produk'
            )
            ->whereBetween(
                'pesanan.tanggal_pesanan',
                [$awalBulan, $akhirBulan]
            )
            ->where('pesanan.status_pesanan', '!=', 'Dibatalkan')
            ->selectRaw(
                'COALESCE(SUM((detail_pesanan.harga_satuan - produk.harga_modal) * detail_pesanan.jumlah), 0) AS total_profit'
            )
            ->value('total_profit');

        // Jumlah pelanggan terdaftar
        $jumlahPelanggan = Pelanggan::count();

        // Tujuh pesanan terbaru
        $pesananTerbaru = Pesanan::with([
            'pelanggan',
            'detail.produk'
        ])
        ->latest('tanggal_pesanan')
        ->limit(7)
        ->get();

        return view('admin.dashboard', compact(
            'jumlahPesananMasuk',
            'penjualanBulanIni',
            'produkTerjual',
            'profitBulanan',
            'jumlahPelanggan',
            'pesananTerbaru'
        ));
    }
}

