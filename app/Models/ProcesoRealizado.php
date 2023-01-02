<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcesoRealizado extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha',
        'proceso_modulo_id',
        'modulo_id',
    ];

    public function procesoModulo()
    {
        return $this->belongsTo(ProcesoModulo::class);
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }
}
