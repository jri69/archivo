<?php

namespace App\Http\Livewire\Documentos\Movimiento;

use App\Models\User;
use Livewire\Component;

class LwCreate extends Component
{
    public $recepcion;
    public $hasDocument;
    public $datos = [];

    public function mount()
    {
    }

    public function hadDoc()
    {
        $this->hadDocument = "true";
        $this->render();
    }

    public function render()
    {
        $usuarios = User::all();
        return view('livewire..documentos.movimiento.lw-create', compact('usuarios'));
    }
}
