<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitulacionDirectivo extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function directivo()
    {
        return $this->belongsTo(Directivo::class);
    }

    public function titulacion()
    {
        return $this->belongsTo(Titulacion::class);
    }
}
