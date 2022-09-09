<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubPartida extends Model
{
    use HasFactory;
    protected $table = 'sub_partidas';
    protected $fillable = [
        'partida_id','codigo','nombre'
    ];

    public function sub_partidas(){
        return $this->belongsTo(SubPartida::class,'partida_id');
    }
}
