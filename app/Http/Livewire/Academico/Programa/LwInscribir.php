<?php

namespace App\Http\Livewire\Academico\Programa;

use App\Models\Estudiante;
use App\Models\EstudianteModulo;
use App\Models\EstudiantePrograma;
use App\Models\Modulo;
use App\Models\NotasPrograma;
use App\Models\Programa;
use Livewire\Component;

class LwInscribir extends Component
{
    public $modulo;
    public $programa;
    public $attribute = '';
    public $type = 'nombre';
    public $sort = 'id';
    public $direction = 'desc';
    public $listEstudents = [];

    public function mount($modulo, $programa)
    {
        $this->modulo = Modulo::findOrFail($modulo);
        $this->programa = Programa::findOrFail($programa);
        $inscritos = EstudianteModulo::where('id_modulo', $this->modulo->id)->get();
        // añadir a la lista de estudiantes los que ya estan inscritos
        foreach ($inscritos as $inscrito) {
            array_push($this->listEstudents, $inscrito->id_estudiante);
        }
    }

    public function save()
    {
        foreach ($this->listEstudents as $estudiante) {
            $est = EstudianteModulo::where('id_estudiante', $estudiante)->where('id_modulo', $this->modulo->id)->first();
            if ($est) {
                continue;
            }
            EstudianteModulo::create([
                'id_estudiante' => $estudiante,
                'id_modulo' => $this->modulo->id,
            ]);
            NotasPrograma::create([
                'id_programa' => $this->programa->id,
                'id_estudiante' => $estudiante,
                'id_modulo' => $this->modulo->id,
                'nota' => 0,
                'observaciones' => '',
            ]);
        }
        $newList = EstudianteModulo::where('id_modulo', $this->modulo->id)->get();
        // verificar que los estudiantes que estan en la lista de estudiantes esten inscritos
        foreach ($newList as $inscrito) {
            if (!in_array($inscrito->id_estudiante, $this->listEstudents)) {
                $inscrito->delete();
                $nota = NotasPrograma::where('id_programa', $this->programa->id)->where('id_estudiante', $inscrito->id_estudiante)->where('id_modulo', $this->modulo->id)->first();
                $nota->delete();
            }
        }

        return redirect()->route('programa.modulo', [$this->programa->id, $this->modulo->id]);
    }

    public function add($estudiante)
    {
        // esta el valor de estudiante en el array
        if (in_array($estudiante, $this->listEstudents)) {
            // eliminar el valor del array
            $this->listEstudents = array_diff($this->listEstudents, [$estudiante]);
        } else {
            // agregar el valor al array
            array_push($this->listEstudents, $estudiante);
        }
    }

    public function render()
    {
        $estudianteP = EstudiantePrograma::where('id_programa', $this->programa->id)->get();
        $estudiantes = Estudiante::whereIn('id', $estudianteP->pluck('id_estudiante'))->orderBy($this->sort, $this->direction)->get();
        // filtrar estudiantes por nombre y cedula
        $estudiantes = $estudiantes->filter(function ($estudiante) {
            return str_contains(strtolower($estudiante->nombre), strtolower($this->attribute)) || str_contains(strtolower($estudiante->cedula), strtolower($this->attribute));
        });
        return view('livewire.academico.programa.lw-inscribir', compact('estudiantes'));
    }
}
