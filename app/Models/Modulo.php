<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;
    protected $fillable = ['estado', 'nombre', 'sigla', 'version', 'edicion', 'costo', 'fecha_inicio', 'fecha_final', 'docente_id', 'programa_id'];

    public function programa()
    {
        $programaModulo = ProgramaModulo::where('id_modulo', $this->id)->first();
        return Programa::find($programaModulo->id_programa);
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }
}
