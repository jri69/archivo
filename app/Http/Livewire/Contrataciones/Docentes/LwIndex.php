<?php

namespace App\Http\Livewire\Contrataciones\Docentes;

use App\Models\Docente;
use Livewire\WithPagination;
use Livewire\Component;

class LwIndex extends Component
{
    use WithPagination;
    public $pagination = 20;
    public $attribute = '';
    public $sort = 'id';
    public $direction = 'desc';
    protected $paginationTheme = 'bootstrap';

    //Metodo de reinicio de buscador
    public function updatingAttribute()
    {
        $this->resetPage();
    }

    public function render()
    {
        $docentes = Docente::where('nombre', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('apellido', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('cedula', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('correo', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('telefono', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);
        return view('livewire.contrataciones.docentes.lw-index', compact('docentes'));
    }
}
