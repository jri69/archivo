<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Third_Partida extends Model
{
    use HasFactory;
    protected $table = 'third_partidas';
    protected $fillable = [
        'second_partida_id','codigo','nombre'
    ];

    public function sub_partidas(){
        return $this->belongsTo(Third_Partida::class,'second_partida_id');
    }

    public function Thirdpartidas(){
        return $this->hasMany(Third_Partida::class,'third_partida_id');
    }
}
