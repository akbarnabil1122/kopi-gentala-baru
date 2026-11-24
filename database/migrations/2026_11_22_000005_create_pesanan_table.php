<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->foreignId('id_pelanggan')->constrained('pelanggan', 'id_pelanggan');
            $table->foreignId('id_admin')->nullable()->constrained('admin', 'id_admin')->nullOnDelete();
            $table->dateTime('tanggal_pesanan')->useCurrent();
            $table->decimal('total_harga', 12, 2)->default(0);
            $table->enum('status_pesanan', ['Pesanan Masuk', 'Diproses', 'Dikemas', 'Dikirim', 'Diantar', 'Selesai', 'Dibatalkan'])->default('Pesanan Masuk');
            $table->text('catatan')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};