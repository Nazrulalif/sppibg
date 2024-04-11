<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usul_kategori extends Model
{
    use HasFactory;
    protected $table = 'usul_kategori';
    protected $fillable = [
        'id_usul',
        'nama_kategori',
    ];
}
