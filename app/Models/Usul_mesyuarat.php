<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usul_mesyuarat extends Model
{
    use HasFactory;

    protected $table = 'usul_mesyuarat';
    protected $fillable = [
        'id_pengguna',
        'usul',
        'id_mesyuarat',
        'id_kategori',
        'status',
        'pengesahan',
        'created_at',
    ];
}
