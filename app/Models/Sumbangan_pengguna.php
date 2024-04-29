<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sumbangan_pengguna extends Model
{
    use HasFactory;

    protected $table = 'sumbangan_pengguna';
    protected $fillable = [
        'id_sumbangan',
        'id_pengguna',
        'jumlah_sumbangan',
        'id_transaksi',
        'status',

    ];
}
