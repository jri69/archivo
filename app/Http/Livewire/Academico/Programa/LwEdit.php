<?php

namespace App\Http\Livewire\Academico\Programa;

use App\Models\Modulo;
use App\Models\Programa;
use App\Models\ProgramaCalendar;
use App\Models\ProgramaModulo;
use Livewire\Component;

class LwEdit extends Component
{
    public $datos = [];
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
        $this->programa->update($this->datos);
        $calendarInicio = ProgramaCalendar::where('programa_id', $this->programa->id)->where('tipo_fecha', 'inicio')->first();
        $calendarFin = ProgramaCalendar::where('programa_id', $this->programa->id)->where('tipo_fecha', 'final')->first();
        $calendarInicio->update([
            'title' => $this->programa->nombre,
            'start' => $this->programa->fecha_inicio,
            'end' => $this->programa->fecha_inicio,
            'sigla' => $this->programa->sigla . ' - ' . $this->programa->version . '.' . $this->programa->edicion,
            'tipo' => $this->programa->tipo
        ]);
        $calendarFin->update([
            'title' => $this->programa->nombre,
            'start' => $this->programa->fecha_finalizacion,
            'end' => $this->programa->fecha_finalizacion,
            'sigla' => $this->programa->sigla . '-' . $this->programa->version . '.' . $this->programa->edicion,
            'tipo' => $this->programa->tipo
        ]);
        return redirect()->route('programa.show', $this->programa);
    }

    public function render()
    {
        return view('livewire.academico.programa.lw-edit');
    }
}
