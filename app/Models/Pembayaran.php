<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_pesanan', 'metode_pembayaran', 'jumlah_bayar',
        'status_pembayaran', 'waktu_bayar', 'referensi_transaksi',
    ];

    protected function casts(): array
    {
        return [
            'jumlah_bayar' => 'decimal:2',
            'waktu_bayar' => 'datetime',
        ];
    }

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}