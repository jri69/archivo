<?php

namespace App\Http\Livewire\Academico\Programa;

use App\Models\NotasPrograma;
use App\Models\Programa;
use App\Models\ProgramaModulo;
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
            $this->notas[$nota->id] = $nota->nota;
            $this->observaciones[$nota->id] = $nota->observaciones;
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
        if ($this->modulo->estado != "Finalizado") {
            $this->modulo->estado = "Finalizado";
            $this->modulo->save();
        }
        return redirect()->route('programa.modulo', [$this->programa, $this->modulo]);
    }

    public function render()
    {
        return view('livewire.academico.programa.lw-notas');
    }
}
