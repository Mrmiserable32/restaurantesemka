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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelanggan_id');
            $table->unsignedBigInteger('meja_id');
            $table->string('kode_booking',20)->unique();
            $table->dateTime('tgl_jam_trx')->useCurrent();
            $table->enum('status_pembayaran_dp',['pending','reserved','chekin','done','failed']);
            $table->double('nominal_hp');
            $table->string('metode_pembayaran',50);
            $table->enum('status_pembayaran_trx',['deny','pending','cancel','settlement','expired',]);
            $table->double('total_bayar');
            $table->double('kekurangan');
            $table->string('metode_pembayaran_trx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
