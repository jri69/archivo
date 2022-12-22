<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planilla_sueldos extends Model
{
    use HasFactory;

    protected $table = 'planilla_sueldos';
    protected $fillable = [
        'administrativo_id', 'horas_faltas', 'sueldo_basico', 'total_ganado', 'sueldo_total', 'facturacion', 'factura'
    ];
}