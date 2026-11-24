<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminProdukController extends Controller
{
    // Menampilkan halaman manajemen produk
    public function index(Request $request)
    {
        $cari = $request->query('cari');

        $produk = Produk::query()
            ->when($cari, function ($query, $cari) {
                $query->where('nama_produk', 'like', "%{$cari}%");
            })
            ->orderBy('id_produk')
            ->paginate(10)
            ->withQueryString();

        $totalProduk = Produk::count();
        $totalStok = Produk::sum('stok');
        $stokMenipis = Produk::where('stok', '<=', 10)->count();

        return view('admin.produk.index', compact(
            'produk',
            'totalProduk',
            'totalStok',
            'stokMenipis',
            'cari'
        ));
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_produk' => 'required|string|max:100',
            'jenis_kopi' => [
                'required',
                Rule::in(['Kopi Bubuk', 'Kopi Roasted']),
            ],
            'deskripsi' => 'nullable|string',
            'ukuran_kemasan' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'harga_modal' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            // Maksimal gambar 10 MB
            'gambar' => 'nullable|image|max:10240',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')
                ->store('produk', 'public');
        }

        $data['status_aktif'] = true;

        Produk::create($data);

        return redirect()
            ->route('admin.produk.index')
            ->with('success_popup', 'tambah');
    }

    // Mengelola stok produk: menambah atau mengurangi
    public function update(Request $request, Produk $produk)
    {
        $data = $request->validate([
            'aksi_stok' => 'required|in:tambah,kurangi',
            'jumlah_stok' => 'required|integer|min:1',
        ], [
            'aksi_stok.required' => 'Pilih perubahan stok terlebih dahulu.',
            'jumlah_stok.required' => 'Jumlah stok wajib diisi.',
            'jumlah_stok.integer' => 'Jumlah stok harus berupa angka bulat.',
            'jumlah_stok.min' => 'Jumlah stok minimal 1.',
        ]);

        $jumlah = (int) $data['jumlah_stok'];

        if ($data['aksi_stok'] === 'tambah') {
            $produk->stok += $jumlah;
        } else {
            if ($jumlah > $produk->stok) {
                return back()
                    ->withErrors([
                        'jumlah_stok' => 'Jumlah pengurangan melebihi stok yang tersedia.',
                    ])
                    ->withInput();
            }

            $produk->stok -= $jumlah;
        }

        $produk->save();

        return redirect()
            ->route('admin.produk.index')
            ->with('success_popup', 'edit');
    }

    // Menghapus atau menonaktifkan produk
    public function destroy(Produk $produk)
    {
        // Produk yang sudah digunakan dalam pesanan/keranjang
        // dinonaktifkan agar riwayat transaksi tetap aman.
        if (
            $produk->detailPesanan()->exists() ||
            $produk->keranjang()->exists()
        ) {
            $produk->update([
                'status_aktif' => false,
            ]);

            return redirect()
                ->route('admin.produk.index')
                ->with('success_popup', 'hapus');
        }

        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()
            ->route('admin.produk.index')
            ->with('success_popup', 'hapus');
    }

    // Mengunduh laporan stok CSV
    public function exportStok()
    {
        $produk = Produk::orderBy('nama_produk')->get();

        $namaFile = 'laporan-stok-gentala-' . now()->format('Ymd-His') . '.csv';

        return response()->streamDownload(function () use ($produk) {
            $output = fopen('php://output', 'w');

            // BOM agar karakter CSV terbaca baik oleh Excel
            fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($output, [
                'No',
                'Nama Produk',
                'Jenis',
                'Ukuran Kemasan (gram)',
                'Harga',
                'Harga Modal',
                'Stok',
                'Status',
            ], ';');

            foreach ($produk as $index => $item) {
                $status = $item->stok <= 0
                    ? 'Habis'
                    : ($item->stok <= 10 ? 'Stok Menipis' : 'Tersedia');

                fputcsv($output, [
                    $index + 1,
                    $item->nama_produk,
                    $item->jenis_kopi,
                    $item->ukuran_kemasan,
                    $item->harga,
                    $item->harga_modal,
                    $item->stok,
                    $status,
                ], ';');
            }

            fclose($output);
        }, $namaFile, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
