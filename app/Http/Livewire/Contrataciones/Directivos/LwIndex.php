<?php

namespace App\Http\Livewire\Contrataciones\Directivos;

use App\Models\Directivo;
use Livewire\Component;
use Livewire\WithPagination;

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
        $directivos = Directivo::where('nombre', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('apellido', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('cargo', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('institucion', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('activo', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orderBy('activo', $this->direction)
            ->paginate($this->pagination);
        return view('livewire.contrataciones.directivos.lw-index', compact('directivos'));
    }
}
