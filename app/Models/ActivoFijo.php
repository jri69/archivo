<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivoFijo extends Model
{
    use HasFactory;
    protected $fillable = ['codigo', 'nombre', 'descripcion', 'unidad', 'estado', 'tipo', 'id_usuario', 'id_area'];


    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
