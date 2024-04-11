<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Minit_mesyuarat extends Model
{
    use HasFactory;
    protected $table = 'minit_mesyuarat';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_mesyuarat',
        'fail',

    ];
}
