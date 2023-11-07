<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago_estudiante extends Model
{
    use HasFactory;

    protected $table = 'pago_estudiante';
    protected $fillable = [
        'convalidacion',
        'estado',
        'estudiante_id',
        'tipo_descuento_id',
        'programa_id'
    ];

    public function estudiante()
    {
        return $this->belongsTo(estudiante::class, 'estudiante_id');
    }
    public function tipo_descuento()
    {
        return $this->belongsTo(tipo_descuento::class, 'tipo_descuento_id');
    }

    public function programa()
    {
        return $this->belongsTo(programa::class, 'programa_id');
    }


    static function calcularEstadoDeuda(Pago_estudiante $pago_estudiante)
    {
        $programa = Programa::find($pago_estudiante->programa_id);
        $descuento  = ($programa->costo * $pago_estudiante->tipo_descuento->monto) / 100;
        $monto_pagado = Pago::where('pago_estudiante_id', $pago_estudiante->id)->sum('monto');
        $cantidad_modulos = $programa->cantidad_modulos;
        $precio_modulo = $programa->costo / $cantidad_modulos;
        $cantidad_modulo_inscritos = EstudianteModulo::where('estudiante_id', $pago_estudiante->estudiante_id)->where('programa_id', $pago_estudiante->programa_id)->count();




        $monto_adeudado = 0;
        $pagado_adeudado = $monto_pagado + $monto_adeudado;
        $monto_total = ($programa->costo - $pago_estudiante->convalidacion) - $descuento;
        $deuda = $monto_total - $pagado_adeudado;

        if ($monto_adeudado > 0) {
            $pago_estudiante->estado = 'CON DEUDA';
        } else {
            $pago_estudiante->estado = 'SIN DEUDA';
        }
    }
}
