<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasPrograma extends Model
{
    use HasFactory;
    protected $fillable = ['nota', 'observaciones', 'id_estudiante_programa', 'id_modulo'];

    public function estudiantePrograma()
    {
        return $this->belongsTo(EstudiantePrograma::class, 'id_estudiante_programa');
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'id_modulo');
    }
}
