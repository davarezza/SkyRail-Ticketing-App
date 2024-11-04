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
        Schema::create('rutes', function (Blueprint $table) {
            $table->id('id_rute');
            $table->string('tujuan');
            $table->string('rute_awal'); 
            $table->string('rute_akhir');
            $table->decimal('harga', 10, 2);
            $table->foreignId('id_transportasi')->constrained('transportasis', 'id_transportasi')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rutes');
    }
};
