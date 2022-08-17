<?php

namespace App\Http\Livewire\Academico\Programa;

use App\Models\EstudiantePrograma;
use App\Models\Modulo;
use App\Models\NotasPrograma;
use App\Models\Programa;
use App\Models\ProgramaModulo;
use Livewire\Component;

class LwCreate extends Component
{
    public $datos = [];

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
        ]);
        Programa::create([
            'nombre' => $this->datos['nombre'],
            'sigla' => $this->datos['sigla'],
            'version' => $this->datos['version'],
            'edicion' => $this->datos['edicion'],
            'fecha_inicio' => $this->datos['fecha_inicio'],
            'fecha_finalizacion' => $this->datos['fecha_finalizacion'],
            'cantidad_modulos' => 0,
            'costo' => $this->datos['costo'],
        ]);

        return redirect()->route('programa.index');
    }

    public function render()
    {
        return view('livewire.academico.programa.lw-create');
    }
}
