<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna_panggilan_mesyuarat extends Model
{
    use HasFactory;

    protected $table = 'pengguna_panggilan_mesyuarat';
    protected $fillable = [
        'id_pengguna',
        'id_panggilan',
    ];
}
