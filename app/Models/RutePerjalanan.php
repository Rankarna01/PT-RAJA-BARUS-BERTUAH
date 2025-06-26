<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RutePerjalanan extends Model
{
    use HasFactory;
    protected $table = 'rute_perjalanan';
    protected $fillable = ['asal', 'tujuan', 'harga'];
}