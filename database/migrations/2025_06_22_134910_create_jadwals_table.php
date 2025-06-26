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
    Schema::create('jadwal', function (Blueprint $table) {
        $table->id();
        $table->foreignId('rute_perjalanan_id')->constrained('rute_perjalanan')->onDelete('cascade');
        $table->foreignId('mobil_id')->constrained('mobil')->onDelete('cascade');
        $table->dateTime('waktu_berangkat');
        $table->decimal('harga', 10, 2);
        $table->boolean('apakah_aktif')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};