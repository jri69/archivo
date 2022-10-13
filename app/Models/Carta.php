<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carta extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo_admi',
        'fecha',
        'tipo',
    ];

    public function directivos()
    {
        return $this->belongsToMany(Directivo::class, 'carta_directivos');
    }
}
