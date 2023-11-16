<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pago';
    protected $fillable = [
        'monto',
        'fecha',
        'comprobante',
        'compro_file',
        'observaciones',
        'modulo_id',
        'pago_estudiante_id',
        'tipo_pago_id',
    ];

    public function pago_estudiante()
    {
        return $this->belongsTo(Pago_estudiante::class, 'pago_estudiante_id');
    }

    public function tipo_pago()
    {
        return $this->belongsTo(Tipo_pago::class, 'tipo_pago_id');
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'modulo_id');
    }
}
