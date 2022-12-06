<?php

namespace App\Http\Livewire\Academico\Estudiante;

use App\Models\EstudianteModulo;
use App\Models\EstudiantePrograma;
use App\Models\Modulo;
use App\Models\NotasPrograma;
use App\Models\Programa;
use Livewire\Component;

class LwNewProgram extends Component
{
    public $estudiante;
    public $programa_id = '';
    public $modulo_id = '';

    public function save()
    {
        $this->validate([
            'programa_id' => 'required',
            'modulo_id' => 'required',
        ], [
            'programa_id.required' => 'El campo programa es obligatorio',
            'modulo_id.required' => 'El campo módulo es obligatorio',
        ]);
        EstudiantePrograma::create([
            'id_estudiante' => $this->estudiante->id,
            'id_programa' => $this->programa_id,
        ]);
        EstudianteModulo::create([
            'id_estudiante' => $this->estudiante->id,
            'id_modulo' => $this->modulo_id,
        ]);
        NotasPrograma::create([
            'id_estudiante' => $this->estudiante->id,
            'id_programa' => $this->programa_id,
            'id_modulo' => $this->modulo_id,
            'nota' => 0,
            'observaciones' => ''
        ]);
        return redirect()->route('estudiante.show', $this->estudiante->id);
    }

    public function render()
    {
        $programaEstudiante = EstudiantePrograma::where('id_estudiante', $this->estudiante->id)->get();
        $idProgramas = $programaEstudiante->pluck('id_programa')->toArray();
        $programas = Programa::whereNotIn('id', $idProgramas)
            ->where('fecha_finalizacion', '>=', now())
            ->get();
        if ($this->programa_id) {
            $programa = Programa::findOrFail($this->programa_id);
            $modulos = Modulo::where('programa_id', $programa->id)->get();
        } else {
            $modulos = [];
        }
        return view('livewire.academico.estudiante.lw-new-program', compact('programas', 'modulos'));
    }
}
