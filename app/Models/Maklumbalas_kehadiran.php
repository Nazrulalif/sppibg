<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maklumbalas_kehadiran extends Model
{
    use HasFactory;
    protected $table = 'maklumbalas_kehadiran';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_pengguna',
        'id_mesyuarat',
        'status',
        'alasan',
    ];
}
