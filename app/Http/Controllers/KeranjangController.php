<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class KeranjangController extends Controller
{
    public function index()
    {
        $item = Keranjang::with('produk')
            ->where('id_pelanggan', Auth::guard('pelanggan')->id())
            ->orderBy('id_keranjang')
            ->get();

        $total = $item->sum(fn ($i) => $i->produk->harga * $i->jumlah);

        return view('keranjang.index', compact('item', 'total'));
    }

    public function tambah(Request $request)
    {
        $data = $request->validate([
            'id_produk' => ['required', 'integer', 'exists:produk,id_produk'],
            'jumlah' => ['required', 'integer', 'min:1', 'max:999'],
        ], [
            'jumlah.min' => 'Jumlah minimal 1.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',
        ]);

        $produk = Produk::where('status_aktif', true)->findOrFail($data['id_produk']);

        $baris = Keranjang::firstOrNew([
            'id_pelanggan' => Auth::guard('pelanggan')->id(),
            'id_produk' => $produk->id_produk,
        ]);

        $jumlahBaru = ($baris->exists ? $baris->jumlah : 0) + $data['jumlah'];

        if ($jumlahBaru > $produk->stok) {
            return back()->withErrors([
                'jumlah' => "Stok tidak mencukupi. Stok tersedia: {$produk->stok}, di keranjang Anda: " . ($baris->exists ? $baris->jumlah : 0) . '.',
            ]);
        }

        $baris->jumlah = $jumlahBaru;
        $baris->save();

        if ($request->boolean('langsung')) {
            return redirect()->route(Route::has('checkout') ? 'checkout' : 'keranjang.index');
        }

        return back()->with('status', 'Produk ditambahkan ke keranjang.');
    }

    public function ubah(Request $request, Keranjang $keranjang)
    {
        $this->pastikanMilikSendiri($keranjang);

        $data = $request->validate([
            'jumlah' => ['required', 'integer', 'min:1', 'max:999'],
        ], [
            'jumlah.min' => 'Jumlah minimal 1.',
        ]);

        $stok = $keranjang->produk->stok;

        if ($data['jumlah'] > $stok) {
            return back()->withErrors(['jumlah' => "Stok tidak mencukupi. Stok tersedia: {$stok}."]);
        }

        $keranjang->update(['jumlah' => $data['jumlah']]);

        return back();
    }

    public function hapus(Keranjang $keranjang)
    {
        $this->pastikanMilikSendiri($keranjang);
        $keranjang->delete();

        return back()->with('status', 'Produk dihapus dari keranjang.');
    }

    private function pastikanMilikSendiri(Keranjang $keranjang): void
    {
        abort_unless($keranjang->id_pelanggan === Auth::guard('pelanggan')->id(), 404);
    }
}