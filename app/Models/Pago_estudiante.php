<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago_estudiante extends Model
{
    use HasFactory;

    protected $table = 'pago_estudiante';
    protected $fillable = [
        'estudiante_id',
        'tipo_descuento_id',
        'convalidacion'
    ];

    public function estudiante()
    {
        return $this->belongsTo(estudiante::class, 'estudiante_id');
    }
    public function tipo_descuento()
    {
        return $this->belongsTo(tipo_descuento::class, 'tipo_descuento_id');
    }
}