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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('amount', 15, 2);
            $table->enum('type', ['income', 'expense']); // 'income' for penerimaan, 'expense' for pengeluaran
            $table->string('payer_name')->nullable(); // Nama pembayar
            $table->decimal('balance', 15, 2)->default(0); // Saldo terkini
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
