<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCarta extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nombre',
        'tipo',
    ];
}
