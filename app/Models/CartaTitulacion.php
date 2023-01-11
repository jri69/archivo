<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartaTitulacion extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function titulacion()
    {
        return $this->belongsTo(Titulacion::class);
    }

    public function tipo()
    {
        return $this->belongsTo(TipoCarta::class);
    }
}
