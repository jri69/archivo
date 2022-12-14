<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;
    protected $fillable = [
        'modulo_id',
        'fecha_inicio',
        'fecha_final',
        'horarios',
        'pagado',
        'nro_preventiva',
        'honorario',
        'comprobante',
        'dir_comprobante',
    ];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }

    public function formulario_c1()
    {
        return $this->hasOne(Formulario_c1::class);
    }

    public function formulario_c2()
    {
        return $this->hasOne(Formulario_c2::class);
    }

    public function cartas()
    {
        return $this->belongsToMany(Carta::class, 'contrato_cartas');
    }
}
