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
    protected $paginationTheme = 'bootstrap';
    public $filtro = '';

    public function updatingAttribute()
    {
        $this->resetPage();
    }

    public function plazo_fijo()
    {
        $this->filtro = 'Plazo Fijo';
    }

    public function consultor()
    {
        $this->filtro = 'Consultor';
    }

    public function todos()
    {
        $this->filtro = '';
    }

    public function render()
    {
        $administrativo = Administrativo::when($this->filtro, function ($query, $filtro) {
            return $query->where('contrato', '=', $filtro);
        })->where(function ($query) {
            $query->where('nombre', 'ILIKE', '%' . strtolower($this->attribute) . '%')
                ->orWhere('ci', 'ILIKE', '%' . strtolower($this->attribute) . '%')
                ->orWhere('apellido', 'ILIKE', '%' . strtolower($this->attribute) . '%');
        })->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);
        return view('livewire.administrativo.administrativos.index', compact('administrativo'));
    }
}
