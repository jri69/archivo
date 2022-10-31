<?php

namespace App\Http\Livewire\Factura\Factura;

use App\Models\Factura;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $facturas = Factura::all();
        return view('livewire.factura.factura.index', compact('facturas'));
    }
}