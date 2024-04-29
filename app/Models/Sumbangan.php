<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sumbangan extends Model
{
    use HasFactory;

    protected $table = 'sumbangan';
    protected $fillable = [
        'nama_sumbangan',
        'penerangan',
        'jumlah_sasaran',
        'jenis_pembayaran',
        'status',
    ];
}
