<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mobil', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mobil');      // Contoh: "Avanza", "Xenia"
            $table->string('nomor_polisi')->unique(); // Contoh: "BH 1234 XY"
            $table->integer('kapasitas');      // Contoh: 6
            $table->string('nama_supir');      // Contoh: "Agung"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mobil');
    }
};