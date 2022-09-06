<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{
    use HasFactory;
    protected $fillable = ['codigo', 'fecha', 'departamento', 'descripcion', 'unidad_organizativa_id', 'user_id'];


    public function unidad_organizativa()
    {
        return $this->belongsTo(UnidadOrganizacional::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
}
