<?php

namespace App\Http\Livewire\Academico\Programa;

use App\Models\Modulo;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use Livewire\Component;

class LwEdit extends Component
{
    public $datos = [];
    public $listModulos = [];
    public $idModulo = 'null';
    public $i = 0;
    public $programa;

    protected $messages = [
        'datos.nombre.required' => 'El campo nombre es requerido.',
        'datos.sigla.required' => 'El campo sigla es requerido.',
        'datos.version.required' => 'El campo versión es requerido.',
        'datos.edicion.required' => 'El campo edición es requerido.',
        'datos.fecha_inicio.required' => 'El campo fecha de inicio es requerido.',
        'datos.fecha_finalizacion.required' => 'El campo fecha de finalización es requerido.',
        'datos.costo.required' => 'El campo costo es requerido.',
        'datos.tipo.required' => 'El campo tipo es requerido.',
    ];

    public function mount($programa)
    {
        $this->programa = Programa::find($programa);
        $this->datos['nombre'] = $this->programa->nombre;
        $this->datos['sigla'] = $this->programa->sigla;
        $this->datos['version'] = $this->programa->version;
        $this->datos['edicion'] = $this->programa->edicion;
        $this->datos['fecha_inicio'] = $this->programa->fecha_inicio;
        $this->datos['fecha_finalizacion'] = $this->programa->fecha_finalizacion;
        $this->datos['costo'] = $this->programa->costo;
        $this->datos['cantidad_modulos'] = $this->programa->cantidad_modulos;
        $this->datos['tipo'] = $this->programa->tipo;
        $this->listaV = ProgramaModulo::where('id_programa', $this->programa->id)->get();
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

    // funcion que elimina un modulo de la lista de modulos cuando el valor es id
    public function del($id)
    {
        $this->listaV = array_diff($this->listaV, [$id]);
    }

    public function store()
    {
        $this->validate([
            'datos.nombre' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'datos.sigla' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'datos.version' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'datos.edicion' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'datos.fecha_inicio' => 'required|date',
            'datos.fecha_finalizacion' => 'required|date',
            'datos.costo' => 'required|numeric',
            'datos.tipo' => 'required|string|regex:/^[\pL\s\-]+$/u',
        ]);

        $this->datos['cantidad_modulos'] = sizeof($this->listaV);
        $this->programa->update($this->datos);
        $this->programa->modulos()->sync($this->listaV);
        return redirect()->route('programa.show', $this->programa);
    }
    public function render()
    {
        $lista = Modulo::whereIn('id',  $this->listaV)->get();
        $modulos = Modulo::all();
        $modulos = $modulos->except($this->listaV);
        return view('livewire.academico.programa.lw-edit', compact('modulos', 'lista'));
    }
}
