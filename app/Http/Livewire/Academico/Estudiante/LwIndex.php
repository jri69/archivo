<?php

namespace App\Http\Livewire\Academico\Estudiante;

use App\Models\Estudiante;
use Livewire\Component;
use Livewire\WithPagination;

class LwIndex extends Component
{
    use WithPagination;
    public $pagination = 20;
    public $attribute = '';
    public $sort = 'id';
    public $direction = 'asc';
    protected $paginationTheme = 'bootstrap';

    //Metodo de reinicio de buscador
    public function updatingAttribute()
    {
        $this->resetPage();
    }

    public function render()
    {
        $estudiantes = Estudiante::where('nombre', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('cedula', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('email', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);
        return view('livewire.academico.estudiante.lw-index', compact('estudiantes'));
    }
}
