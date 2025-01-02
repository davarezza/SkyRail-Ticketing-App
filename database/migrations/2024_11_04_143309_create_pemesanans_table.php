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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id('id_pemesanan');
            $table->string('kode_pemesanan');
            $table->date('tanggal_pemesanan');
            $table->string('tempat_pemesanan');
            $table->foreignId('id_penumpang')->constrained('penumpangs', 'id_penumpang')->onDelete('cascade');
            $table->string('kode_kursi');
            $table->foreignId('id_rute')->constrained('rutes', 'id_rute')->onDelete('cascade');
            $table->string('tujuan');
            $table->date('tanggal_berangkat');
            $table->time('jam_check_in');
            $table->time('jam_berangkat');
            $table->decimal('total_bayar', 15, 2);
            $table->foreignId('id_petugas')->constrained('petugas', 'id_petugas')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
