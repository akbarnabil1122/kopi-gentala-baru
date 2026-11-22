<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Kopi Gentala – Biji Kopi Sangrai', 'Kopi Roasted', 'Biji kopi utuh pilihan yang disangrai sempurna untuk menjaga keaslian aroma dan rasa kuat khas Jangkat.', 500, 75000, 55000, 70],
            ['Kopi Gentala – Kopi Bubuk', 'Kopi Bubuk', 'Kopi bubuk siap seduh yang praktis dengan tekstur halus, menghadirkan kehangatan rasa yang pas di setiap cangkir.', 250, 50000, 35000, 50],
        ];

        foreach ($data as [$nama, $jenis, $deskripsi, $berat, $harga, $modal, $stok]) {
            Produk::firstOrCreate(['nama_produk' => $nama], [
                'jenis_kopi' => $jenis,
                'deskripsi' => $deskripsi,
                'ukuran_kemasan' => $berat,
                'harga' => $harga,
                'harga_modal' => $modal,
                'stok' => $stok,
                'status_aktif' => true,
            ]);
        }
    }
}