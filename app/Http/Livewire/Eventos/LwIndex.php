<?php

namespace App\Http\Livewire\Eventos;

use App\Models\Evento;
use Livewire\WithPagination;
use Livewire\Component;
use Psy\Readline\Hoa\EventSource;

class LwIndex extends Component
{
    use WithPagination;
    public $pagination = 30;
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
        $eventos = Evento::where('titulo', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('lugar', 'ILIKE', '%' .  strtolower($this->attribute) . '%')
            ->orWhere('encargado', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);
        return view('livewire.eventos.lw-index', compact('eventos'));
    }
}
