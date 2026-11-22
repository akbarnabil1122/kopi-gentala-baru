<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Keranjang extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id_keranjang';

    protected $fillable = ['id_pelanggan', 'id_produk', 'jumlah'];

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}