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
    Schema::create('pemesanan_kursi', function (Blueprint $table) {
        $table->id();
        $table->foreignId('perjalanan_id')->constrained('perjalanan')->onDelete('cascade');
        $table->foreignId('pemesanan_id')->constrained('pemesanan')->onDelete('cascade');
        $table->integer('nomor_kursi');
        $table->timestamps();
        $table->unique(['perjalanan_id', 'nomor_kursi']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_kursis');
    }
};