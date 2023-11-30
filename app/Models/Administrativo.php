<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrativo extends Model
{
    use HasFactory;
    protected $table = 'administrativos';
    protected $fillable = [
        'nombre', 'apellido', 'ci', 'expedicion', 'contrato', 'cargo_id', 'fecha_ingreso', 'fecha_retiro', 'foto', 'sueldo'
    ];
}
