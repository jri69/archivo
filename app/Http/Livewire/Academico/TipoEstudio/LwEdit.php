<?php

namespace App\Http\Livewire\Academico\TipoEstudio;

use App\Models\Estudio_modulo;
use App\Models\Modulo;
use App\Models\Tipo_estudio;
use Livewire\Component;

class LwEdit extends Component
{
    public $listaV = [];
    public $datos = [];
    public $estudio;
    public $i;
    public $idModulo = 'null';
    protected $messages = [
        'datos.nombre.required' => 'El campo nombre es requerido.',
        'datos.sigla.required' => 'El campo sigla es requerido.',
    ];

    public function mount($tipos_estudios)
    {
        $this->estudio = Tipo_estudio::find($tipos_estudios);
        $this->datos['nombre'] = $this->estudio->nombre;
        $this->datos['sigla'] = $this->estudio->sigla;
        $this->listaV = Estudio_modulo::where('tipo_estudio_id', $tipos_estudios)->get();
        $this->listaV = $this->listaV->pluck('id')->toArray();
        $this->i = count($this->listaV);
    }

    public function add()
    {
        if ($this->idModulo != 'null') {
            $this->i++;
            $this->listaV[$this->i] = $this->idModulo;
            $this->idModulo = 'null';
        }
    }

    public function update()
    {
        $this->validate([
            'datos.nombre' => 'required',
            'datos.sigla' => 'required',
        ]);
        $this->estudio->update($this->datos);
        $this->estudio->modulos()->sync($this->listaV);
        return redirect()->route('estudio.index');
    }

    public function render()
    {
        $lista = Modulo::whereIn('id',  $this->listaV)->get();
        $modulos = Modulo::all();
        $modulos = $modulos->except($this->listaV);
        return view('livewire.academico.tipo-estudio.lw-edit', compact('modulos', 'lista'));
    }
}
