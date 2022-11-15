<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cuadroEvaluativo extends Model
{
    use HasFactory;
    protected $fillable = [
        'formacion',
        'cursos_continuo',
        'experiencia_general',
        'nacionalidad',
        'experiencia_especifica',
        'formacion_continua',
        'propuesta_tecnica',
        'carta_id',
    ];
}
