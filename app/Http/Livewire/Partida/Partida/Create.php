<?php

namespace App\Http\Livewire\Partida\Partida;

use App\Models\Partida;
use Livewire\Component;

class Create extends Component
{
    public $datos = [];
    public $i = 0;
    public $partida;
    
    public function store(){
        
    }

    public function add($id)
    {
        if($id == 'NULL'){
            $this->i++;

        }
    }
    public function render()
    {
        $c = $this->i;
        $partidas = Partida::all();
        return view('livewire.partida.partida.create',compact('partidas'));
    }
}
