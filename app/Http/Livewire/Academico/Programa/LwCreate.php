<?php

namespace App\Http\Livewire\Academico\Programa;

use App\Models\Programa;
use App\Models\ProgramaCalendar;
use Livewire\Component;

class LwCreate extends Component
{
    public $datos = [];

    public function mount()
    {
        $datos['codigo'] = '';
        $datos['nombre'] = '';
        $datos['sigla'] = '';
        $datos['version'] = '';
        $datos['edicion'] = '';
        $datos['fecha_inicio'] = '';
        $datos['fecha_finalizacion'] = '';
        $datos['costo'] = '';
        $datos['modalidad'] = 'Presencial';
        // $datos['tipo'] = 'Sin tipo';
    }

    public function store()
    {
        $this->validate(
            [
                'datos.codigo' => 'required|string',
                'datos.nombre' => 'required|string|max:255',
                'datos.sigla' => 'required|string|max:50',
                'datos.version' => 'required|string|max:10',
                'datos.edicion' => 'required|string|max:10',
                'datos.fecha_inicio' => 'required|date',
                'datos.fecha_finalizacion' => 'required|date',
                'datos.costo' => 'required|numeric',
                'datos.tipo' => 'required|string|max:20',
                'datos.modalidad' => 'required|string|max:20',
                'datos.hrs_academicas' => 'required|numeric',
            ],
            [
                'datos.codigo.required' => 'El campo codigo es obligatorio',
                'datos.nombre.required' => 'El campo nombre es obligatorio',
                'datos.sigla.required' => 'El campo sigla es obligatorio',
                'datos.version.required' => 'El campo version es obligatorio',
                'datos.edicion.required' => 'El campo edicion es obligatorio',
                'datos.fecha_inicio.required' => 'El campo fecha de inicio es obligatorio',
                'datos.fecha_finalizacion.required' => 'El campo fecha de finalizacion es obligatorio',
                'datos.costo.required' => 'El campo costo es obligatorio',
                'datos.tipo.required' => 'El campo tipo es obligatorio',
                'datos.modalidad.required' => 'El campo modalidad es obligatorio',
                'datos.hrs_academicas.required' => 'El campo horas academicas es obligatorio',
                'datos.hrs_academicas.numeric' => 'El campo horas academicas debe ser un numero',
            ]
        );
        //aumentar cantidad_modulos
        $this->datos['cantidad_modulos'] = 0;
        $programa = Programa::create($this->datos);
        ProgramaCalendar::create([
            'title' => $programa->nombre,
            'start' => $programa->fecha_inicio,
            'end' => $programa->fecha_inicio,
            'sigla' => $programa->sigla . ' - ' . $programa->version . '.' . $programa->edicion,
            'tipo' => $programa->tipo,
            'tipo_fecha' => 'inicio',
            'programa_id' => $programa->id,
        ]);
        ProgramaCalendar::create([
            'title' => $programa->nombre,
            'start' => $programa->fecha_finalizacion,
            'end' => $programa->fecha_finalizacion,
            'sigla' => $programa->sigla . '-' . $programa->version . '.' . $programa->edicion,
            'tipo' => $programa->tipo,
            'tipo_fecha' => 'final',
            'programa_id' => $programa->id,
        ]);
        return redirect()->route('programa.index');
    }

    public function render()
    {
        return view('livewire.academico.programa.lw-create');
    }
}
