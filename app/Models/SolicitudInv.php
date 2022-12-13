<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudInv extends Model
{
    use HasFactory;
    protected $fillable = [
        'cantidad',
        'inventario_id',
        'solicitud_id',
    ];

    public function inventario()
    {
        return $this->belongsTo(Inventario::class);
    }
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }
}
