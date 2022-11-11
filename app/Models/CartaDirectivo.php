<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartaDirectivo extends Model
{
    use HasFactory;
    protected $fillable = [
        'directivo_id',
        'carta_id',
    ];

    public function carta()
    {
        return $this->belongsTo(Carta::class);
    }

    public function directivo()
    {
        return $this->belongsTo(Directivo::class);
    }
}
