<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengiriman extends Model
{
    protected $table = 'pengiriman';
    protected $primaryKey = 'id_pengiriman';

    protected $fillable = [
        'id_pesanan', 'metode_pengiriman', 'nama_ekspedisi', 'no_resi',
        'alamat_tujuan', 'biaya_kirim', 'status_pengiriman',
    ];

    protected function casts(): array
    {
        return ['biaya_kirim' => 'decimal:2'];
    }

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}