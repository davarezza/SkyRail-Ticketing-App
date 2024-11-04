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
        Schema::create('transportasis', function (Blueprint $table) {
            $table->id('id_transportasi');
            $table->string('kode');
            $table->integer('jumlah_kursi');
            $table->text('keterangan')->nullable();
            $table->foreignId('id_type_transportasi')->constrained('type_transportasis', 'id_type_transportasi')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transportasis');
    }
};
