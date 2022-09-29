<?php

namespace App\Http\Livewire\Partida\Partida;

use App\Models\Partida;
use App\Models\SubPartida;
use Livewire\Component;

class Create extends Component
{
    
    public $datos = [];
    public $codigo;
    public $nombre;
    public $i = 0;
    public $partida_id;

    public function mount(){
        $datos['partida_id']='';
        $datos['codigo'] = '';
        $datos['nombre']='';
    }
    
    public function store(){
        //dd($this->partida_id);
        //$inicio = reset($this->datos);
        //dd($inicio['nombre']);
        $fin = end($this->datos);
        $this->validate([
            'partida_id'=>'required',
            'codigo'=>'required',
            'nombre'=>'required'            
        ]);
        //dd($fin['id']);
       //dd($this->datos[2]['nombre']);
       for ($a=1; $a <= $fin['id'] ; $a++) {
            SubPartida::create([
                'partida_id'=> $this->partida_id,
                'codigo'=> $this->datos[$a]['codigo'],
                'nombre'=> $this->datos[$a]['nombre']
            ]);
       }
       
        return redirect()->route('subpartida.index');
    }

    public function del($id){
        
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
        $partidas = Partida::orderBy('id','asc')->get();
        return view('livewire.partida.partida.create',compact('partidas','listas'));
    }
}
