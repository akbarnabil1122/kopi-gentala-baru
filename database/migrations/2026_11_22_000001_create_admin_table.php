<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id('id_admin');
            $table->string('nama_admin', 100);
            $table->string('email', 100)->unique();
            $table->string('password_hash', 255);
            $table->boolean('mfa_enabled')->default(true);
            $table->string('mfa_secret', 255)->nullable();
            $table->unsignedTinyInteger('failed_login_attempts')->default(0);
            $table->dateTime('locked_until')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};