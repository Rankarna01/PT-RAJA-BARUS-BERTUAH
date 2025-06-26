<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rute_perjalanan', function (Blueprint $table) {
            $table->id();
            $table->string('asal');  // Contoh: "Medan"
            $table->string('tujuan'); // Contoh: "Barus"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rute_perjalanan');
    }
};