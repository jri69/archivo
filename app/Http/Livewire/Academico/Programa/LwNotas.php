<?php

namespace App\Http\Livewire\Academico\Programa;

use App\Models\Programa;
use Livewire\Component;

class LwNotas extends Component
{
    public $programa;
    public $modulo;
    public $estudiante_programa;
    public $notas = [];
    public $observaciones = [];

    public function mount($programa, $modulo, $estudiante_programa)
    {
        $this->programa = $programa;
        $this->modulo = $modulo;
        $this->estudiante_programa = $estudiante_programa;
        foreach ($this->estudiante_programa as $nota) {
            $this->notas[$nota->id] = $nota->nota;
            $this->observaciones[$nota->id] = $nota->observacion;
        }
    }

    public function render()
    {
        return view('livewire.academico.programa.lw-notas');
    }
}
