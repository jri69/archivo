<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carta extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo_admi',
        'fecha',
        'tipo_id',
        'fecha_plazo',
        'contrato_id',
        'campo_adicional_uno',
        'campo_adicional_dos',
        'campo_adicional_tres',
        'campo_adicional_cuatro',
        'campo_adicional_cinco',
        'campo_adicional_seis',
    ];

    public function directivos()
    {
        return $this->belongsToMany(Directivo::class, 'carta_directivos');
    }

    public function tipo()
    {
        return $this->belongsTo(TipoCarta::class, 'tipo_id');
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'contrato_id');
    }
}
