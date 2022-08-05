<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_descuento extends Model
{
    use HasFactory;

    protected $table = 'tipo_descuento';
    protected $fillable = [
            'nombre',
            'monto',
            'archivo'
    ];

    public function pago_estudiante(){
        return $this->hasMany(pago_estudiante::class, 'tipo_descuento_id');
    }
}
