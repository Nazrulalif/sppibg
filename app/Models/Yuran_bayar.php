<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yuran_bayar extends Model
{
    use HasFactory;

    protected $table = 'yuran_bayar';
    protected $fillable = [
        'id_pembayaran',
        'id_yuran',
        // 'id_pengguna',
        'id_pelajar',
        // 'jumlah_bayar',
        // 'jumlah_yang_tinggal',
        // 'cara_bayar',
        // 'penerangan',
        'jumlah_yuran',
        'jenis_pembayaran',
        'status',

    ];
}
