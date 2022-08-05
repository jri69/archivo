<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'sigla', 'version', 'edicion', 'fecha_inicio', 'fecha_finalizacion', 'cantidad_modulos', 'costo'];

    public function modulos()
    {
        return $this->belongsToMany(Modulo::class, 'programa_modulos', 'id_programa', 'id_modulo');
    } 

    
}
