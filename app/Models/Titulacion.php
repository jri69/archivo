<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Titulacion extends Model
{
    use HasFactory;
    // opuesto a fillable
    protected $guarded = [];

    public function programa()
    {
        return $this->belongsTo(Programa::class);
    }

    public function cartas()
    {
        return $this->hasMany(CartaTitulacion::class);
    }

    public function directivos()
    {
        return $this->hasMany(Directivo::class);
    }

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }
}
