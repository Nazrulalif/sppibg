<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan_usul extends Model
{
    use HasFactory;

    protected $table = 'ulasan_usul';
    protected $fillable = [
        'id_usul',
        'ulasan',
        'created_at',


    ];
}
