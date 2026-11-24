<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Kopi Gentala – Biji Kopi Sangrai', 'Kopi Roasted', 'Biji kopi utuh pilihan yang disangrai sempurna untuk menjaga keaslian aroma dan rasa kuat khas Jangkat.', 500, 75000, 55000, 70, 'produk1.png'],
            ['Kopi Gentala – Kopi Bubuk', 'Kopi Bubuk', 'Kopi bubuk siap seduh yang praktis dengan tekstur halus, menghadirkan kehangatan rasa yang pas di setiap cangkir.', 250, 50000, 35000, 50, 'produk2.png'],
        ];

        foreach ($data as [$nama, $jenis, $deskripsi, $berat, $harga, $modal, $stok, $gambar]) {
            Produk::firstOrCreate(['nama_produk' => $nama], [
                'jenis_kopi' => $jenis,
                'deskripsi' => $deskripsi,
                'ukuran_kemasan' => $berat,
                'harga' => $harga,
                'harga_modal' => $modal,
                'stok' => $stok,
                'gambar' => $gambar,
                'status_aktif' => true,
            ]);
        }
    }
}
