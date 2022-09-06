<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'tipo', 'dir', 'movimiento_doc_id', 'recepcion_id'];
}
