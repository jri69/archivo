<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaModulo extends Model
{
    use HasFactory;
    protected $fillable = ['id_programa', 'id_modulo'];

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'id_programa');
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'id_modulo');
    }
}
