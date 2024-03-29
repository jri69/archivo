<?php

namespace App\Http\Livewire\Tics\Tics;

use App\Models\Tic;
use Livewire\Component;
use Livewire\WithPagination;

class LwIndex extends Component
{
    use WithPagination;
    public $pagination = 20;
    public $attribute = '';
    public $type = 'id';
    public $sort = 'id';
    public $direction = 'asc';

    //paginacion bootstrap
    protected $paginationTheme = 'bootstrap';

    //Metodo de reinicio de buscador
    public function updatingAttribute()
    {
        $this->resetPage();
    }

    public function render()
    {
        $productos = Tic::orWhere('nombre', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('id', 'ILIKE', '%' . $this->attribute . '%')
            ->orWhere('modelo', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('tipo', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('estado', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);
        return view('livewire.tics.tics.lw-index', compact('productos'));
    }
}
