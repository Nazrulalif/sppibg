<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    use HasFactory;
    protected $table = 'acara';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_acara',
        'tarikh',
        'masa_mula',
        'masa_tamat',
        'kepada',
        'tempat',
        'agenda',
        'warna',

    ];
}
