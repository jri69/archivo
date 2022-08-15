<?php

namespace App\Http\Livewire\Tics\Inventario;

use App\Models\Inventario;
use Livewire\Component;
use Livewire\WithPagination;

class LwIndex extends Component
{
    use WithPagination;
    public $pagination = 10;
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
        $productos = Inventario::where('nombre', 'like', '%' . $this->attribute . '%')
            ->orWhere('id', 'like', '%' . $this->attribute . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);
        return view('livewire.tics.inventario.lw-index', compact('productos'));
    }
}
