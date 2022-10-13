<?php

namespace App\Http\Livewire\Contrataciones\Contrataciones;

use App\Models\Contrato;
use App\Models\Modulo;
use Livewire\Component;

class LwCreate extends Component
{
    public $modulos;
    public $datos = [];

    public function mount()
    {
        $this->datos['modulo_id'] = '';
        $contratos = Contrato::all();
        $modulos_contratos = $contratos->pluck('modulo_id');
        $this->modulos = Modulo::whereNotIn('id', $modulos_contratos)->get();
    }

    public function save()
    {
        $this->validate([
            'datos.modulo_id' => 'required|numeric',
            'datos.fecha_inicio' => 'required|date',
            'datos.fecha_final' => 'required|date',
            'datos.horarios' => 'required|string',
            'datos.honorario' => 'required|string',
        ], [
            'datos.modulo_id.required' => 'El campo módulo es obligatorio',
            'datos.modulo_id.numeric' => 'El campo módulo debe ser un número',
            'datos.fecha_inicio.required' => 'El campo fecha de inicio es obligatorio',
            'datos.fecha_inicio.date' => 'El campo fecha de inicio debe ser una fecha',
            'datos.fecha_final.required' => 'El campo fecha final es obligatorio',
            'datos.fecha_final.date' => 'El campo fecha final debe ser una fecha',
            'datos.horarios.required' => 'El campo horarios es obligatorio',
            'datos.horarios.string' => 'El campo horarios debe ser un texto',
            'datos.honorario.required' => 'El campo honorario es obligatorio',
            'datos.honorario.string' => 'El campo honorario debe ser un texto',
        ]);
        $this->datos['pagado'] = false;
        Contrato::create($this->datos);
        return redirect()->route('contrataciones.index');
    }

    public function render()
    {
        if ($this->datos['modulo_id']) {
            $modulo = Modulo::find($this->datos['modulo_id']);
            $this->datos['docente'] =  $modulo->docente->honorifico . ' ' . $modulo->docente->nombre . ' ' . $modulo->docente->apellido;
        }

        return view('livewire.contrataciones.contrataciones.lw-create');
    }
}
