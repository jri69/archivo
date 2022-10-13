<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario_c1 extends Model
{
    use HasFactory;
    protected $fillable = ['formacion', 'cursos', 'experiencia', 'nacionalidad', 'contrato_id'];

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }
}
