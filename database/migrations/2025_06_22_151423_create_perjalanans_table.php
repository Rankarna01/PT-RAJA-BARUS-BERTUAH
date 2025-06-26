<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perjalanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mobil_id')->constrained('mobil')->onDelete('cascade');
            $table->foreignId('rute_perjalanan_id')->constrained('rute_perjalanan')->onDelete('cascade');
            $table->date('tanggal_berangkat');
            $table->time('jam_berangkat');
            // Status untuk menandai apakah perjalanan ini aktif, sudah berangkat, dll. (opsional untuk masa depan)
            $table->string('status')->default('Tersedia'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perjalanan');
    }
};