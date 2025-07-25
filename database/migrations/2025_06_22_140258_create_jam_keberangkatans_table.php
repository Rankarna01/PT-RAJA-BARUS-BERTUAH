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
    Schema::create('jam_keberangkatan', function (Blueprint $table) {
        $table->id();
        $table->string('hari'); // Contoh: Senin, Selasa, ...
        $table->time('jam');    // Contoh: 08:00:00
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jam_keberangkatans');
    }
};