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
        Schema::create('table_kategori', function (Blueprint $table) {
            $table->id();
            $table->string('kategori')->unique(); // Kategori
            $table->decimal('jumlah', 15, 2)->default(0); // Jumlah Pengeluaran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_kategori');
    }
};
