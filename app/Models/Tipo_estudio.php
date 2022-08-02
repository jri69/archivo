<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_estudio extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'sigla'];

    public function modulos()
    {
        return $this->belongsToMany(Modulo::class, 'estudio_modulos');
    }
}
