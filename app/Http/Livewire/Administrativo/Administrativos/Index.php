<?php

namespace App\Http\Livewire\Administrativo\Administrativos;

use App\Models\Administrativo;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $pagination = 10;
    public $attribute = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $vacio = [];
    protected $paginationTheme = 'bootstrap';
    //Metodo de reinicio de buscador
    public function updatingAttribute()
    {
        $this->resetPage();
    }
    public function render()
    {
        $administrativo = Administrativo::where('nombre', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('ci', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('apellido', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);


        return view('livewire.administrativo.administrativos.index', compact('administrativo'));
    }
}