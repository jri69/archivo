<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'email', 'estado', 'telefono', 'cedula', 'carrera', 'universidad'];

    public function pago_estudiante()
    {
        return $this->hasMany(pago_estudiante::class, 'estudiante_id');
    }

    public function estudiante_programa()
    {
        return $this->hasMany(estudiante_programa::class, 'estudiante_id');
    }

    public function requisito_estudiante()
    {
        return $this->hasMany(requisito_estudiante::class, 'estudiante_id');
    }

    public function requisitos()
    {
        return $this->belongsToMany(Requisito::class, 'requisito_estudiantes', 'id_estudiante', 'id_requisito');
    }
}
