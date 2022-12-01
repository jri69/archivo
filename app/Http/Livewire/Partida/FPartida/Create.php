<?php

namespace App\Http\Livewire\Partida\FPartida;

use App\Models\Fifth_Partida;
use App\Models\Quarter_Partida;
use Livewire\Component;

class Create extends Component
{
    public $datos = [];
    public $codigo;
    public $nombre;
    public $i = 0;
    public $partida_id;

    public function mount()
    {

        $datos['codigo'] = '';
        $datos['nombre'] = '';
    }

    public function store()
    {

        $fin = end($this->datos);
        $this->validate([

            'codigo' => 'required',
            'nombre' => 'required'
        ]);

        for ($a = 1; $a <= $fin['id']; $a++) {
            $prueba = array_key_exists($a, $this->datos);
            if ($prueba) {
                Fifth_Partida::create([
                    'quarter_partida_id' => $this->partida_id,
                    'codigo' => $this->datos[$a]['codigo'],
                    'nombre' => $this->datos[$a]['nombre']
                ]);
            }
        }

        return redirect()->route('f_partida.index');
    }

    public function del($id)
    {

        $remove = $this->datos[$id];
        $this->datos = array_diff_key($this->datos, array_flip($remove));
    }

    public function add()
    {
        $aux = [];

        $this->i++;
        $aux['id'] = $this->i;
        $aux['codigo'] = $this->codigo;
        $aux['nombre'] = $this->nombre;
        $this->datos[$this->i] = $aux;
    }
    public function render()
    {
        $listas = $this->datos;
        $partidas = Quarter_Partida::orderBy('id', 'asc')->get();
        return view('livewire.partida.f-partida.create', compact('listas', 'partidas'));
    }
}