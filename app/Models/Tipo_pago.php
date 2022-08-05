<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_pago extends Model
{
    use HasFactory;

    protected $table = 'tipo_pagos';
    protected $fillable = [
        'nombre'
    ];

    public function pago(){
        return $this->hasMany(pago::class, 'tipo_pago_id');
    }
}
