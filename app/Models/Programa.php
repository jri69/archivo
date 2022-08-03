<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;
    protected $fillable = ['fecha_inicio', 'costo', 'id_tipo_estudio'];

    public function tipo_estudio()
    {
        return $this->belongsTo(Tipo_estudio::class, 'id_tipo_estudio');
    }
 
    public function estudiante_programa()
    {
        return $this->hasMany(EstudiantePrograma::class, 'id_programa');
    }
    
}
