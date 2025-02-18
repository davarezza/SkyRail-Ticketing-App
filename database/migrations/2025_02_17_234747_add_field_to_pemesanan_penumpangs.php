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
        Schema::table('pemesanan_penumpangs', function (Blueprint $table) {
            $table->unsignedBigInteger('id_rute')->nullable();
            $table->foreign('id_rute')->references('id_rute')->on('rutes')->onDelete('cascade');
            $table->unsignedBigInteger('id_transportasi')->nullable();
            $table->foreign('id_transportasi')->references('id_transportasi')->on('transportasis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemesanan_penumpangs', function (Blueprint $table) {
            //
        });
    }
};
