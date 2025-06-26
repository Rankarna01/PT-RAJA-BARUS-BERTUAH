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
    Schema::create('pemesanan', function (Blueprint $table) {
        $table->id();
        $table->string('nomor_tiket')->unique();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('perjalanan_id')->constrained('perjalanan')->onDelete('cascade');
        $table->string('nama_penumpang');
        $table->string('nomor_telepon');
        $table->text('alamat_jemput');
        $table->integer('jumlah_kursi');
        $table->decimal('total_pembayaran', 10, 2);
        $table->string('metode_pembayaran');
        $table->string('bukti_pembayaran')->nullable();
        $table->enum('status_pembayaran', ['menunggu', 'lunas', 'batal', 'gagal'])->default('menunggu');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};