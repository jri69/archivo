<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;
    protected $fillable = ['estado', 'hrs_academicas', 'nombre', 'sigla', 'version', 'edicion', 'modalidad', 'costo', 'fecha_inicio', 'fecha_final', 'docente_id', 'programa_id'];

    public function programa()
    {
        return $this->belongsTo(Programa::class);
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }
}
