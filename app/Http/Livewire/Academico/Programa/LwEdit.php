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
    public $modulos;

    protected $messages = [
        'datos.nombre.required' => 'El campo nombre es requerido.',
        'datos.sigla.required' => 'El campo sigla es requerido.',
        'datos.version.required' => 'El campo versión es requerido.',
        'datos.edicion.required' => 'El campo edición es requerido.',
        'datos.fecha_inicio.required' => 'El campo fecha de inicio es requerido.',
        'datos.fecha_finalizacion.required' => 'El campo fecha de finalización es requerido.',
        'datos.costo.required' => 'El campo costo es requerido.',
        'datos.tipo.required' => 'El campo tipo es requerido.',
        'datos.modalidad.required' => 'El campo modalidad es requerido.',
        'datos.hrs_academicas.required' => 'El campo horas académicas es requerido.',
        'datos.hrs_academicas.numeric' => 'El campo horas académicas debe ser un número.',
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
        $this->datos['modalidad'] = $this->programa->modalidad;
        $this->datos['hrs_academicas'] = $this->programa->hrs_academicas;
        $this->listaV = ProgramaModulo::where('id_programa', $this->programa->id)->get();
        $this->listaV = $this->listaV->pluck('id')->toArray();
        $this->i = count($this->listaV);
        $this->modulos = Modulo::where('fecha_final', '>', now())->get();
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
            'datos.nombre' => 'required|string',
            'datos.sigla' => 'required|string',
            'datos.version' => 'required|string',
            'datos.edicion' => 'required|string',
            'datos.fecha_inicio' => 'required|date',
            'datos.fecha_finalizacion' => 'required|date',
            'datos.costo' => 'required|numeric',
            'datos.tipo' => 'required|string',
            'datos.modalidad' => 'required|string',
            'datos.hrs_academicas' => 'required|numeric',
        ]);

        $this->datos['cantidad_modulos'] = sizeof($this->listaV);
        $this->programa->update($this->datos);
        $this->programa->modulos()->sync($this->listaV);
        return redirect()->route('programa.show', $this->programa);
    }
    public function render()
    {
        $lista = Modulo::whereIn('id',  $this->listaV)->get();
        $this->modulos = $this->modulos->except($this->listaV);
        return view('livewire.academico.programa.lw-edit', compact('lista'));
    }
}
