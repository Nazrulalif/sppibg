<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panggilan_mesyuarat extends Model
{
    use HasFactory;

    protected $table = 'panggilan_mesyuarat';
    protected $fillable = [
        'nama_panggilan',
        'id_mesyuarat',
        'tandatangan',
        'draf',
        // 'hubungan',
    ];
}
