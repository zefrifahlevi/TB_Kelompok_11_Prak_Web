<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('table_transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('category'); // Kategori (Kas Tunai, Transfer, dll.)
            $table->decimal('uang_masuk', 15, 2)->default(0); // Masuk
            $table->decimal('uang_keluar', 15, 2)->default(0); // Keluar
            $table->decimal('saldo', 15, 2)->default(0); // Saldo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_transaksi');
    }
};
