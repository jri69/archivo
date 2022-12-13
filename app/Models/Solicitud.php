<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $fillable = [
        'cantidad',
        'estado',
        'tic_id',
        'user_id',
    ];

    public function tic()
    {
        return $this->belongsTo(Tic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
