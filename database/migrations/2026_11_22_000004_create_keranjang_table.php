<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keranjang', function (Blueprint $table) {
            $table->id('id_keranjang');
            $table->foreignId('id_pelanggan')->constrained('pelanggan', 'id_pelanggan')->cascadeOnDelete();
            $table->foreignId('id_produk')->constrained('produk', 'id_produk');
            $table->unsignedInteger('jumlah')->default(1);
            $table->unique(['id_pelanggan', 'id_produk']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};