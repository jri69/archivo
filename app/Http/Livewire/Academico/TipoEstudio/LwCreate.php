<?php

namespace App\Http\Livewire\Academico\TipoEstudio;

use App\Models\Estudio_modulo;
use App\Models\Modulo;
use App\Models\Tipo_estudio;
use Livewire\Component;

class LwCreate extends Component
{
    public $listModulos = [];
    public $datos = [];
    public $idModulo = 'null';
    public $i = 0;

    protected $messages = [
        'datos.nombre.required' => 'El campo nombre es requerido.',
        'datos.sigla.required' => 'El campo sigla es requerido.',
        'datos.version.required' => 'El campo versión es requerido.',
        'datos.edicion.required' => 'El campo edición es requerido.',
    ];

    public function mount()
    {
        $datos['nombre'] = '';
        $datos['sigla'] = '';
        $datos['version'] = '';
        $datos['edicion'] = '';
    }

    public function add()
    {
        if ($this->idModulo != 'null') {
            $this->listModulos[$this->i] = $this->idModulo;
            $this->i++;
            $this->idModulo = 'null';
        }
    }

    public function store()
    {
        $this->validate([
            'datos.nombre' => 'required',
            'datos.sigla' => 'required',
            'datos.version' => 'required',
            'datos.edicion' => 'required',
        ]);
        $estudio = Tipo_estudio::create($this->datos);
        foreach ($this->listModulos as $id) {
            Estudio_modulo::create([
                'tipo_estudio_id' => $estudio->id,
                'modulo_id' => $id,
            ]);
        };
        return redirect()->route('estudio.index');
    }

    public function render()
    {
        $modulos = Modulo::all();
        $modulos = $modulos->except($this->listModulos);
        $lista = Modulo::whereIn('id',  $this->listModulos)->get();
        return view('livewire.academico.tipo-estudio.lw-create', compact('modulos', 'lista'));
    }
}
