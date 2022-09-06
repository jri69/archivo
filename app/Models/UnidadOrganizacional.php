<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadOrganizacional extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function recepciones()
    {
        return $this->hasMany(Recepcion::class);
    }
}
