<?php

namespace App\Http\Livewire\Factura\DetalleFactura;

use Livewire\Component;
use App\Models\Fifth_Partida;
use App\Models\Partida;
use App\Models\Quarter_Partida;
use App\Models\SubPartida;
use App\Models\Third_Partida;

class Edit extends Component
{
    public $first = 1;
    public $second;
    public $third;
    public $four;

    public $listaSegundo = [];
    public $listaTercero = [];
    public $listaCuarto = [];
    public $listaQuinto = [];
    public $id_factura;
    public $detalle;
    public function segundo()
    {
        $this->listaSegundo = SubPartida::select('id', 'nombre', 'codigo')->where('partida_id', '=', $this->first)->get();
    }
    public function tercero()
    {
        $this->listaTercero = Third_Partida::where('second_partida_id', '=', $this->second)->get();
    }
    public function cuarto()
    {
        $this->listaCuarto = Quarter_Partida::where('third_partida_id', '=', $this->third)->get();
    }
    public function quinto()
    {
        $this->quinto = Fifth_Partida::where('quarter_partida_id', '=', $this->four)->get();
    }

    public function render()
    {
        $id = $this->id_factura;
        $detalle = $this->detalle;
        $primero = Partida::all();
        if ($this->listaSegundo == null) {
            $segundo = SubPartida::all();
        } else {
            $segundo = $this->listaSegundo;
        }
        if ($this->listaTercero == null) {
            $tercero = Third_Partida::all();
        } else {
            $tercero = $this->listaTercero;
        }
        if ($this->listaCuarto == null) {
            $cuarto = Quarter_Partida::all();
        } else {
            $cuarto = $this->listaCuarto;
        }
        if ($this->listaQuinto == null) {
            $quinto = Fifth_Partida::all();
        } else {
            $quinto = $this->listaQuinto;
        }
        return view('livewire.factura.detalle-factura.edit', compact('primero', 'segundo', 'tercero', 'cuarto', 'quinto', 'id', 'detalle'));
    }
}