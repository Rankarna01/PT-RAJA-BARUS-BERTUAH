<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamKeberangkatan extends Model
{
    use HasFactory;
    protected $table = 'jam_keberangkatan';
    protected $fillable = ['hari', 'jam'];
}