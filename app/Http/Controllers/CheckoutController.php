<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Keranjang;
use App\Models\Pembayaran;
use App\Models\Pengiriman;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    public function form()
    {
        $pelanggan = Auth::guard('pelanggan')->user();

        $item = Keranjang::with('produk')
            ->where('id_pelanggan', $pelanggan->id_pelanggan)
            ->orderBy('id_keranjang')
            ->get();

        if ($item->isEmpty()) {
            return redirect()->route('keranjang.index')
                ->withErrors(['jumlah' => 'Keranjang Anda masih kosong.']);
        }

        $subtotal = $item->sum(fn ($i) => $i->produk->harga * $i->jumlah);
        $ongkirEkspedisi = (int) config('kopigentala.ongkir_ekspedisi');

        return view('checkout.index', compact('pelanggan', 'item', 'subtotal', 'ongkirEkspedisi'));
    }

    public function simpan(Request $request)
    {
        $pelanggan = Auth::guard('pelanggan')->user();

        $data = $request->validate([
            'nama_penerima' => ['required', 'string', 'max:100'],
            'no_telepon' => ['required', 'regex:/^(\+62|62|0)8[0-9]{8,11}$/'],
            'negara' => ['required', 'string', 'max:60'],
            'kota_kecamatan' => ['required', 'string', 'max:100'],
            'alamat_lengkap' => ['required', 'string', 'max:500'],
            'catatan' => ['nullable', 'string', 'max:500'],
            'metode_pengiriman' => ['required', 'in:Antar Langsung,Ekspedisi'],
            'metode_pembayaran' => ['required', 'in:QRIS'],
        ], [
            'nama_penerima.required' => 'Nama penerima wajib diisi.',
            'no_telepon.required' => 'Nomor HP wajib diisi.',
            'no_telepon.regex' => 'Nomor HP tidak valid (contoh: 081234567890).',
            'negara.required' => 'Negara wajib diisi.',
            'kota_kecamatan.required' => 'Kota dan kecamatan wajib diisi.',
            'alamat_lengkap.required' => 'Alamat lengkap wajib diisi.',
            'metode_pengiriman.required' => 'Pilih metode pengiriman.',
            'metode_pengiriman.in' => 'Metode pengiriman tidak valid.',
            'metode_pembayaran.required' => 'Pilih metode pembayaran.',
            'metode_pembayaran.in' => 'Metode pembayaran belum tersedia. Silakan pilih QRIS.',
        ]);

        $alamatLengkap = "{$data['alamat_lengkap']}, {$data['kota_kecamatan']}, {$data['negara']}";
        $alamatTujuan = "Penerima: {$data['nama_penerima']} ({$data['no_telepon']})\n{$alamatLengkap}";

        $pesanan = DB::transaction(function () use ($pelanggan, $data, $alamatLengkap, $alamatTujuan) {
            $keranjang = Keranjang::where('id_pelanggan', $pelanggan->id_pelanggan)->get();

            if ($keranjang->isEmpty()) {
                throw ValidationException::withMessages(['keranjang' => 'Keranjang Anda masih kosong.']);
            }

            $subtotal = 0;
            $baris = [];

            foreach ($keranjang as $k) {
                $produk = Produk::lockForUpdate()->find($k->id_produk);

                if (! $produk || ! $produk->status_aktif) {
                    throw ValidationException::withMessages(['keranjang' => 'Salah satu produk di keranjang sudah tidak tersedia.']);
                }

                if ($k->jumlah > $produk->stok) {
                    throw ValidationException::withMessages(['keranjang' => "Stok {$produk->nama_produk} tidak mencukupi (tersedia {$produk->stok})."]);
                }

                $harga = (float) $produk->harga;
                $sub = $harga * $k->jumlah;
                $subtotal += $sub;
                $baris[] = [$produk, $k->jumlah, $harga, $sub];
            }

            $ongkir = $data['metode_pengiriman'] === 'Ekspedisi'
                ? (float) config('kopigentala.ongkir_ekspedisi')
                : 0.0;

            $pesanan = Pesanan::create([
                'id_pelanggan' => $pelanggan->id_pelanggan,
                'tanggal_pesanan' => now(),
                'total_harga' => $subtotal,
                'status_pesanan' => 'Pesanan Masuk',
                'catatan' => $data['catatan'] ?? null,
            ]);

            foreach ($baris as [$produk, $jumlah, $harga, $sub]) {
                DetailPesanan::create([
                    'id_pesanan' => $pesanan->id_pesanan,
                    'id_produk' => $produk->id_produk,
                    'jumlah' => $jumlah,
                    'harga_satuan' => $harga,
                    'subtotal' => $sub,
                ]);

                $produk->decrement('stok', $jumlah);
            }

            Pembayaran::create([
                'id_pesanan' => $pesanan->id_pesanan,
                'metode_pembayaran' => 'QRIS',
                'jumlah_bayar' => $subtotal + $ongkir,
                'status_pembayaran' => 'Menunggu Pembayaran',
            ]);

            Pengiriman::create([
                'id_pesanan' => $pesanan->id_pesanan,
                'metode_pengiriman' => $data['metode_pengiriman'],
                'alamat_tujuan' => $alamatTujuan,
                'biaya_kirim' => $ongkir,
                'status_pengiriman' => 'Menunggu Bayar',
            ]);

            Keranjang::where('id_pelanggan', $pelanggan->id_pelanggan)->delete();

            if (trim((string) $pelanggan->alamat) === '') {
                $pelanggan->update(['alamat' => $alamatLengkap]);
            }

            return $pesanan;
        });

        return redirect()->route('pembayaran.tampil', $pesanan);
    }
}