<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitoArchivo extends Model
{
    use HasFactory;
    protected $fillable = ['id_estudiante', 'nombre', 'dir'];
}
