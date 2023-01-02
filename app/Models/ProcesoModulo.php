<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcesoModulo extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'orden',
    ];

    public function procesoRealizados()
    {
        return $this->hasMany(ProcesoRealizado::class);
    }
}
