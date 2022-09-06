<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoDoc extends Model
{
    use HasFactory;
    protected $fillable = ['codigo', 'fecha', 'departamento', 'confirmacion', 'user_id', 'recepcion_id'];

    public function recepcion() 
    {
        return $this->belongsTo(Recepcion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
