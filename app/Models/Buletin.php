<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buletin extends Model
{
    use HasFactory;

    protected $table = 'buletin';
    protected $fillable = [
        'nama_buletin',
        'fail',
        'id_draf',
    ];
}
