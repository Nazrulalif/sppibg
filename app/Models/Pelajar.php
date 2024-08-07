<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelajar extends Model
{
    use HasFactory;
    protected $table = 'pelajar';
    protected $fillable = [
        'nama_pelajar',
        'tahun_pelajar_id',
        'kelas',
        'id_pengguna',
        // 'hubungan',
    ];
}
