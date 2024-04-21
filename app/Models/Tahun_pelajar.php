<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun_pelajar extends Model
{
    use HasFactory;

    protected $table = 'tahun_pelajar';
    protected $fillable = [
        'nama_tahun',
        'ulasan',
        'created_at',
    ];
}
