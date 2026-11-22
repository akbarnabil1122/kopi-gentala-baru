<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->foreignId('id_pesanan')->unique()->constrained('pesanan', 'id_pesanan')->cascadeOnDelete();
            $table->enum('metode_pembayaran', ['QRIS', 'Transfer Bank']);
            $table->decimal('jumlah_bayar', 12, 2);
            $table->enum('status_pembayaran', ['Menunggu Pembayaran', 'Sudah Dibayar', 'Gagal'])->default('Menunggu Pembayaran');
            $table->dateTime('waktu_bayar')->nullable();
            $table->string('referensi_transaksi', 100)->nullable()->unique();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};