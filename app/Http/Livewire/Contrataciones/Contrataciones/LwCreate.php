<?php

namespace App\Http\Livewire\Contrataciones\Contrataciones;

use App\Models\Contrato;
use App\Models\Docente;
use App\Models\Modulo;
use Livewire\Component;

class LwCreate extends Component
{
    public $modulos;
    public $datos = [];
    public $docente;

    public function mount($docente)
    {
        $this->docente = $docente;
        $this->datos['modulo_id'] = '';

        $contratos = Contrato::join('modulos', 'modulos.id', '=', 'contratos.modulo_id')    //contratos del docente
            ->join('docentes', 'docentes.id', '=', 'modulos.docente_id')
            ->select('contratos.*')
            ->where('modulos.docente_id', $docente->id)->get();

        $docente_modulo = Modulo::where('docente_id', $docente->id)->get();   //modulos del docente
        $modulos_contratos = $contratos->pluck('modulo_id');    //contratos del docente

        // modulos sin contrato
        $this->modulos = $docente_modulo->filter(function ($modulo) use ($modulos_contratos) {
            return !$modulos_contratos->contains($modulo->id);
        });

        $this->datos['docente'] =  $this->docente->honorifico . ' ' . $this->docente->nombre . ' ' . $this->docente->apellido;
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
        return redirect()->route('docentes.show', $this->docente->id);
    }

    public function render()
    {
        return view('livewire.contrataciones.contrataciones.lw-create');
    }
}
