<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospecto extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'interes',
        'observaciones',
        'estado',
        'carrera'
    ];
}
