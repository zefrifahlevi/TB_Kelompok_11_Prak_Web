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
        Schema::create('table_kas_harian', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal'); // Tanggal
            $table->decimal('penerimaan', 15, 2)->default(0); // Penerimaan
            $table->decimal('pengeluaran', 15, 2)->default(0); // Pengeluaran
            $table->decimal('saldo', 15, 2)->default(0); // Saldo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_kas_harian');
    }
};
