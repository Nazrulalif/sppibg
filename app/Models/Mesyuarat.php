<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesyuarat extends Model
{
    use HasFactory;
    protected $table = 'mesyuarat';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_mesyuarat',
        'tarikh',
        'masa_mula',
        'masa_tamat',
        'kepada',
        'tempat',
        'agenda',
        'warna',
        'panggilan_status',
    ];
}
