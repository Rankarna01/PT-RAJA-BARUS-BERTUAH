<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rute_perjalanan', function (Blueprint $table) {
            // Menambahkan kolom 'harga' setelah kolom 'tujuan'
            $table->decimal('harga', 10, 2)->after('tujuan')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('rute_perjalanan', function (Blueprint $table) {
            // Logika untuk menghapus kolom jika migrasi di-rollback
            $table->dropColumn('harga');
        });
    }
};