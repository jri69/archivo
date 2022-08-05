<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pago';
    protected $fillable = [
            'pago_estudiante_id',
            'monto',
            'fecha',
            'comprobante',
            'compro_file',
            'tipo_pago_id',
            'observaciones'
    ];

    public function pago_estudiante(){
        return $this->belongsTo(pago_estudiante::class, 'pago_estudiante_id');
    } 

    public function tipo_pago(){
        return $this->belongsTo(tipo_pago::class, 'tipo_pago_id');
    }

    
}
