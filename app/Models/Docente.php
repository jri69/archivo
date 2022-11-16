<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'apellido',
        'honorifico',
        'cedula',
        'expedicion',
        'correo',
        'telefono',
        'facturacion',
    ];

    public function modulos()
    {
        return $this->belongsToMany(Modulo::class);
    }
}
