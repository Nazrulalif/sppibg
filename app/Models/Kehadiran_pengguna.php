<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran_pengguna extends Model
{
    use HasFactory;
    protected $table = 'kehadiran_pengguna';
    protected $fillable = [
        'id_kehadiran',
        'id_pengguna',
        'status',
    ];
}
