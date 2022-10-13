<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario_c2 extends Model
{
    use HasFactory;
    protected $fillable = ['expeciencia_especifica', 'formacion_continua', 'propuesta_tecnica', 'contrato_id'];

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }
}
