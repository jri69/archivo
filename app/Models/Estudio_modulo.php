<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudio_modulo extends Model
{
    use HasFactory;
    protected $fillable = ['tipo_estudio_id', 'modulo_id'];

    public function tipo_estudio()
    {
        return $this->belongsTo(Tipo_estudio::class, 'tipo_estudio_id');
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'modulo_id');
    }
}
