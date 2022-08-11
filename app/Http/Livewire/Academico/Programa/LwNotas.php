<?php

namespace App\Http\Livewire\Academico\Programa;

use App\Models\NotasPrograma;
use App\Models\Programa;
use Livewire\Component;

class LwNotas extends Component
{
    public $programa;
    public $modulo;
    public $estudiante_programa;
    public $notas = [];
    public $observaciones = [];
    public $casa;

    public function mount($programa, $modulo, $estudiante_programa)
    {
        $this->programa = $programa;
        $this->modulo = $modulo;
        $this->estudiante_programa = $estudiante_programa;
        foreach ($this->estudiante_programa as $nota) {
            //elimina espacios en blanco
            //convertir un numero en string

            $name = str_replace(' ', '', $nota->estudiante->nombre . (string) $nota->id);
            //$name = $nota->id;
            $this->notas[$name] = $nota->nota;
            $this->observaciones[$nota->id] = $nota->observacion;
        }
        $this->casa = "Nueva";
    }

    public function save()
    {
        foreach ($this->notas as $key => $nota) {
            $estudiante_programa = NotasPrograma::find($key);
            $estudiante_programa->nota = $nota;
            if ($this->observaciones[$key] != null) {
                $estudiante_programa->observaciones = $this->observaciones[$key];
            }
            $estudiante_programa->save();
        }
        $this->emit('alert', 'success', 'Notas actualizadas');
    }

    public function render()
    {
        return view('livewire.academico.programa.lw-notas');
    }
}
