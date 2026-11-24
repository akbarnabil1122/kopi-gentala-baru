<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->id('id_pengiriman');
            $table->foreignId('id_pesanan')->unique()->constrained('pesanan', 'id_pesanan')->cascadeOnDelete();
            $table->enum('metode_pengiriman', ['Antar Langsung', 'Ekspedisi']);
            $table->string('nama_ekspedisi', 50)->nullable();
            $table->string('no_resi', 50)->nullable();
            $table->text('alamat_tujuan');
            $table->decimal('biaya_kirim', 12, 2)->default(0);
            $table->enum('status_pengiriman', ['Menunggu Bayar', 'Menunggu Kemas', 'Sedang Dikemas', 'Diserahkan ke Kurir', 'Dalam Perjalanan', 'Sedang Diantar', 'Diterima Pelanggan'])->default('Menunggu Bayar');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengiriman');
    }
};