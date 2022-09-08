<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'tipo', 'dir', 'movimiento_doc_id', 'recepcion_id'];

    public function movimiento_doc()
    {
        return $this->belongsTo(MovimientoDoc::class);
    }

    public function recepcion()
    {
        return $this->belongsTo(Recepcion::class);
    }
}
