<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fifth_Partida extends Model
{
    use HasFactory;
    protected $table = 'fifth_partidas';
    protected $fillable = [
        'quarter_partida_id','codigo','nombre'
    ];
}
