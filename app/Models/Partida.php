<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    use HasFactory;
    protected $table = 'partidas';
    protected $fillable = [
        'codigo', 'nombre'
    ];

    public function sub_partidas(){
        return $this->hasMany(partidas::class,'partida_id');
    }
}
