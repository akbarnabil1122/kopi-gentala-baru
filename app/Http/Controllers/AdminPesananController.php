<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminPesananController extends Controller
{
    /**
     * Menampilkan seluruh daftar pesanan.
     */
    public function index(Request $request)
    {
        $query = Pesanan::with([
            'pelanggan',
            'detail.produk',
            'pembayaran',
            'pengiriman',
        ]);

        // Pencarian berdasarkan nama atau ID pelanggan.
        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('pelanggan', function ($q) use ($search) {
                $q->where('nama_pelanggan', 'like', "%{$search}%")
                    ->orWhere('id_pelanggan', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan status pesanan.
        if ($request->filled('status')) {
            $query->where('status_pesanan', $request->status);
        }

        // Mengurutkan pesanan terbaru.
        $pesanan = $query
            ->orderByDesc('tanggal_pesanan')
            ->paginate(10)
            ->withQueryString();

        // Menghitung jumlah pesanan masuk.
        $jumlahPesananMasuk = Pesanan::where(
            'status_pesanan',
            'Pesanan Masuk'
        )->count();

        return view('admin.pesanan.index', compact(
            'pesanan',
            'jumlahPesananMasuk'
        ));
    }

    /**
     * Memperbarui status pesanan dan informasi pengiriman.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima.
        $validated = $request->validate([
            'status_pesanan' => [
                'required',
                Rule::in([
                    'Pesanan Masuk',
                    'Diproses',
                    'Dikemas',
                    'Dikirim',
                    'Diantar',
                    'Selesai',
                    'Dibatalkan',
                ]),
            ],

            'nama_ekspedisi' => [
                'nullable',
                'string',
                'max:50',
            ],

            'no_resi' => [
                'nullable',
                'string',
                'max:50',
            ],
        ]);

        DB::transaction(function () use ($validated, $id) {

            // Mengambil data pesanan beserta pengiriman.
            $pesanan = Pesanan::with('pengiriman')
                ->lockForUpdate()
                ->findOrFail($id);

            $statusBaru = $validated['status_pesanan'];

            // Memperbarui status pesanan.
            $pesanan->update([
                'status_pesanan' => $statusBaru,
                'id_admin' => Auth::guard('admin')->id(),
            ]);

            // Memperbarui data pengiriman jika tersedia.
            if ($pesanan->pengiriman) {

                $dataPengiriman = [];

                // Sinkronisasi status pengiriman.
                $statusPengiriman = [
                    'Pesanan Masuk' => 'Menunggu Bayar',
                    'Diproses' => 'Menunggu Kemas',
                    'Dikemas' => 'Sedang Dikemas',
                    'Dikirim' => 'Diserahkan ke Kurir',
                    'Diantar' => 'Sedang Diantar',
                    'Selesai' => 'Diterima Pelanggan',
                ];

                if (isset($statusPengiriman[$statusBaru])) {
                    $dataPengiriman['status_pengiriman'] =
                        $statusPengiriman[$statusBaru];
                }

                // Menyimpan nama ekspedisi.
                if (
                    array_key_exists('nama_ekspedisi', $validated) &&
                    $validated['nama_ekspedisi'] !== null
                ) {
                    $dataPengiriman['nama_ekspedisi'] =
                        $validated['nama_ekspedisi'];
                }

                // Menyimpan nomor resi tanpa bergantung pada status.
                if (
                    array_key_exists('no_resi', $validated) &&
                    $validated['no_resi'] !== null
                ) {
                    $dataPengiriman['no_resi'] =
                        $validated['no_resi'];
                }

                // Menyimpan perubahan ke database.
                if (!empty($dataPengiriman)) {
                    $pesanan->pengiriman->update($dataPengiriman);
                }
            }
        });

        return redirect()
            ->route('admin.pesanan.index')
            ->with('success', 'Pesanan berhasil diperbarui.');
    }
}
