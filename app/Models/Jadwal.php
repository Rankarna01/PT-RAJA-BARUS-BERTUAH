<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwal';
    protected $fillable = [
        'rute_perjalanan_id',
        'mobil_id',
        'waktu_berangkat',
        'harga',
        'apakah_aktif',
    ];

    public function rutePerjalanan(): BelongsTo
    {
        return $this->belongsTo(RutePerjalanan::class, 'rute_perjalanan_id');
    }

    public function mobil(): BelongsTo
    {
        return $this->belongsTo(Mobil::class, 'mobil_id');
    }
}