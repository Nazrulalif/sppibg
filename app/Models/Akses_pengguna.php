<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akses_pengguna extends Model
{
    use HasFactory;
    protected $table = 'akses_pengguna';
    protected $fillable = [
        'nama_akses',

    ];
}
