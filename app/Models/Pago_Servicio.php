<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago_Servicio extends Model
{
    use HasFactory;
    protected $table = 'pago_servicios';
    protected $fillable = [
        'servicio_id',
        'monto',
        'fecha',
        'comprobante'
    ];

    public function servicio(){
        return $this->belongsTo(servicio::class,'servicio_id');
    }
}
