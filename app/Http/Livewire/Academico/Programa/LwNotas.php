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
    public $errorValidation = false;
    public $idError;
    public $mensaje;

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
        $this->errorValidation = false;
        foreach ($this->notas as $key => $value) {
            if (!is_numeric($value) || $value < 0 || $value > 100) {
                $this->errorValidation = true;
                $this->idError = $key;
                $this->mensaje = "El campo nota debe ser un numero entre 0 y 100";
                return;
            }
        }
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
