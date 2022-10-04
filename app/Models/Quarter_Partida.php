<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quarter_Partida extends Model
{
    use HasFactory;
    protected $table = 'quarter_partidas';
    protected $fillable = [
        'third_partida_id','codigo','nombre'
    ];

    public function sub_partidas(){
        return $this->belongsTo(Third_Partida::class,'third_partida_id');
    }
}
