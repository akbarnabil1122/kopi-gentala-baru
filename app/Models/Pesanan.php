<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';

    protected $fillable = [
        'id_pelanggan', 'id_admin', 'tanggal_pesanan',
        'total_harga', 'status_pesanan', 'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pesanan' => 'datetime',
            'total_harga' => 'decimal:2',
        ];
    }

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }

    public function detail(): HasMany
    {
        return $this->hasMany(DetailPesanan::class, 'id_pesanan');
    }

    public function pembayaran(): HasOne
    {
        return $this->hasOne(Pembayaran::class, 'id_pesanan');
    }

    public function pengiriman(): HasOne
    {
        return $this->hasOne(Pengiriman::class, 'id_pesanan');
    }
}