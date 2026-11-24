<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'nama_produk', 'jenis_kopi', 'deskripsi', 'ukuran_kemasan',
        'harga', 'harga_modal', 'stok', 'gambar', 'status_aktif',
    ];

    protected function casts(): array
    {
        return [
            'harga' => 'decimal:2',
            'harga_modal' => 'decimal:2',
            'status_aktif' => 'boolean',
        ];
    }

    public function keranjang(): HasMany
    {
        return $this->hasMany(Keranjang::class, 'id_produk');
    }

    public function detailPesanan(): HasMany
    {
        return $this->hasMany(DetailPesanan::class, 'id_produk');
    }
}