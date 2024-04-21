<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yuran extends Model
{
    use HasFactory;

    protected $table = 'yuran';
    protected $fillable = [
        'tahun',
        'yuran',
        'tahun_pelajar_id',
        'yuran_tambahan',

    ];
}
