<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perjalanan extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     */
    protected $table = 'perjalanan';

    /**
     * Atribut yang dapat diisi secara massal.
     * PASTIKAN SEMUA FIELD DARI FORM ADA DI SINI.
     */
    protected $fillable = [
        'mobil_id',
        'rute_perjalanan_id',
        'tanggal_berangkat',
        'jam_berangkat',
        'status', // 'status' juga ditambahkan jika Anda ingin bisa mengupdatenya
    ];

    /**
     * Relasi ke model Mobil.
     */
    public function mobil(): BelongsTo
    {
        return $this->belongsTo(Mobil::class, 'mobil_id');
    }

    /**
     * Relasi ke model RutePerjalanan.
     */
    public function rutePerjalanan(): BelongsTo
    {
        return $this->belongsTo(RutePerjalanan::class, 'rute_perjalanan_id');
    }
}