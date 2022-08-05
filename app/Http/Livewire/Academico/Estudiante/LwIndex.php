<?php

namespace App\Http\Livewire\Academico\Estudiante;

use App\Models\Estudiante;
use Livewire\Component;
use Livewire\WithPagination;

class LwIndex extends Component
{
    use WithPagination;
    public $pagination = 10;
    public $attribute = '';
    public $type = 'nombre';
    public $sort = 'nombre';
    public $direction = 'asc';

    //Metodo de reinicio de buscador
    public function updatingAttribute()
    {
        $this->resetPage();
    }

    public function render()
    {
        $estudiantes = Estudiante::where('nombre', 'like', '%' . $this->attribute . '%')
            ->orWhere('cedula', 'like', '%' . $this->attribute . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);
        return view('livewire.academico.estudiante.lw-index', compact('estudiantes'));
    }
}
