<?php

namespace App\Http\Livewire\Academico\Programa;

use App\Models\Programa;
use Livewire\Component;
use Livewire\WithPagination;

class LwIndex extends Component
{
    use WithPagination;
    public $pagination = 20;
    public $attribute = '';
    public $type = 'id';
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
        $programas = Programa::where('nombre', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('sigla', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('tipo', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);
        return view('livewire..academico.programa.lw-index', compact('programas'));
    }
}
