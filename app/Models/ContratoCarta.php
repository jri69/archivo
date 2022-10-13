<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratoCarta extends Model
{
    use HasFactory;
    protected $fillable = [
        'contrato_id',
        'carta_id',
    ];

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }

    public function carta()
    {
        return $this->belongsTo(Carta::class);
    }
}
