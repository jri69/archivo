<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tic extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'estado',
        'observaciones',
        'tipo',
        'modelo',
        'cantidad',
    ];
}
