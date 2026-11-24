<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('nama_produk', 100);
            $table->enum('jenis_kopi', ['Kopi Bubuk', 'Kopi Roasted']);
            $table->text('deskripsi')->nullable();
            $table->unsignedInteger('ukuran_kemasan');
            $table->decimal('harga', 12, 2);
            $table->decimal('harga_modal', 12, 2)->default(0);
            $table->unsignedInteger('stok')->default(0);
            $table->string('gambar', 255)->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};