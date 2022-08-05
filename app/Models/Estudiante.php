<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'email', 'estado', 'telefono', 'cedula', 'carrera', 'universidad'];

public function pago_estudiante(){
        return $this->hasMany(pago_estudiante::class, 'estudiante_id');
    }
}
