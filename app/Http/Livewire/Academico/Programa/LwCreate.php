<?php

namespace App\Http\Livewire\Academico\Programa;

use App\Models\Modulo;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use Livewire\Component;

class LwCreate extends Component
{
    public $datos = [];
    public $listModulos = [];
    public $idModulo = 'null';
    public $i = 0;

    protected $messages = [
        'datos.nombre.required' => 'El campo nombre es requerido.',
        'datos.sigla.required' => 'El campo sigla es requerido.',
        'datos.version.required' => 'El campo versión es requerido.',
        'datos.edicion.required' => 'El campo edición es requerido.',
        'datos.fecha_inicio.required' => 'El campo fecha de inicio es requerido.',
        'datos.fecha_finalizacion.required' => 'El campo fecha de finalización es requerido.',
        'datos.costo.required' => 'El campo costo es requerido.',
    ];

    public function mount()
    {
        $datos['nombre'] = '';
        $datos['sigla'] = '';
        $datos['version'] = '';
        $datos['edicion'] = '';
        $datos['fecha_inicio'] = '';
        $datos['fecha_finalizacion'] = '';
        $datos['costo'] = '';
    }

    public function add()
    {
        if ($this->idModulo != 'null') {
            $this->listModulos[$this->i] = $this->idModulo;
            $this->i++;
            $this->idModulo = 'null';
        }
    }

    // funcion que elimina un modulo de la lista de modulos cuando el valor es id
    public function del($id)
    {
        $this->listModulos = array_diff($this->listModulos, [$id]);
    }

    public function store()
    {
        $this->validate([
            'datos.nombre' => 'required',
            'datos.sigla' => 'required',
            'datos.version' => 'required',
            'datos.edicion' => 'required',
            'datos.fecha_inicio' => 'required',
            'datos.fecha_finalizacion' => 'required',
            'datos.costo' => 'required',
        ]);
        $programa = Programa::create([
            'nombre' => $this->datos['nombre'],
            'sigla' => $this->datos['sigla'],
            'version' => $this->datos['version'],
            'edicion' => $this->datos['edicion'],
            'fecha_inicio' => $this->datos['fecha_inicio'],
            'fecha_finalizacion' => $this->datos['fecha_finalizacion'],
            'cantidad_modulos' => sizeof($this->listModulos),
            'costo' => $this->datos['costo'],
        ]);
        foreach ($this->listModulos as $id) {
            ProgramaModulo::create([
                'id_programa' => $programa->id,
                'id_modulo' => $id,
            ]);
        };
        return redirect()->route('programa.index');
    }

    public function render()
    {
        $modulos = Modulo::all();
        $modulos = $modulos->except($this->listModulos);
        $lista = Modulo::whereIn('id',  $this->listModulos)->get();
        return view('livewire.academico.programa.lw-create', compact('modulos', 'lista'));
    }
}
