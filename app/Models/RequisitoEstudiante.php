<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitoEstudiante extends Model
{
    use HasFactory;
    protected $fillable = ['fecha', 'dir', 'nombre', 'id_requisito', 'id_estudiante'];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante');
    }

    public function requisito()
    {
        return $this->belongsTo(Requisito::class, 'id_requisito');
    }
}
