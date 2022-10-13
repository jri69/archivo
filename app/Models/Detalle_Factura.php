<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_Factura extends Model
{
    use HasFactory;
    protected $table = 'detalle_facturas';
    protected $fillable = [
        'factura_id','primero','segundo','tercero','cuarto','quinto','cantidad','detalle','precio_unitario','subtotal'
    ];
}
