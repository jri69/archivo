<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaCalendar extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'start', 'end', 'tipo', 'tipo_fecha', 'programa_id', 'modulo_id', 'evento_id',
        'nombre', 'modalidad', 'docente', 'lugar', 'hora', 'encargado'
    ];
}
