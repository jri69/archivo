<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasPrograma extends Model
{
    use HasFactory;
    protected $fillable = ['nota', 'nombre_modulo', 'version_modulo', 'edicion_modulo', 'id_programa', 'id_estudiante'];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante');
    }

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'id_programa');
    }
    
}
