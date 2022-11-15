<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaCalendar extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'start', 'end', 'sigla', 'tipo', 'tipo_fecha', 'programa_id'];
}
