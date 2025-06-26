<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; // <-- Import HasMany

class Pemesanan extends Model
{
    use HasFactory;
    protected $table = 'pemesanan';
    
    protected $fillable = [
        'nomor_tiket',
        'user_id',
        'perjalanan_id',
        'nama_penumpang',
        'nomor_telepon',
        'alamat_jemput',
        'jumlah_kursi',
        'total_pembayaran',
        'metode_pembayaran',
        'bukti_pembayaran',
        'status_pembayaran',
    ];

    /**
     * Relasi ke model User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Relasi ke model Perjalanan.
     */
    public function perjalanan(): BelongsTo
    {
        return $this->belongsTo(Perjalanan::class);
    }

    /**
     * Relasi ke kursi yang dipesan untuk pemesanan ini.
     * Satu Pemesanan bisa memiliki banyak kursi (untuk masa depan).
     */
    public function kursiDipesan(): HasMany
    {
        return $this->hasMany(PemesananKursi::class);
    }
}