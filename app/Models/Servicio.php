<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $table = 'servicios';
    protected $fillable = [
        'nombre'
    ];

    public function pago_servicio(){
        return $this->hasMany(pago_servicio::class,'servicio_id');
    }
}
