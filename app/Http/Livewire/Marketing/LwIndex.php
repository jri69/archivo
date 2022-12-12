<?php

namespace App\Http\Livewire\Marketing;

use App\Models\Prospecto;
use Livewire\Component;
use Livewire\WithPagination;

class LwIndex extends Component
{
    use WithPagination;
    public $pagination = 30;
    public $attribute = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $date;
    public $grado;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->date = '';
        $this->grado = '';
    }

    //Metodo de reinicio de buscador
    public function updatingAttribute()
    {
        $this->resetPage();
    }

    public function render()
    {
        $prospectos = Prospecto::where('grado_interes', 'ILIKE', '%' . strtolower($this->grado) . '%')
            ->where('created_at', 'ILIKE', '%' .  strtolower($this->date) . '%')
            ->where('nombre', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            // ->orWhere('telefono', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            // ->where('email', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            // ->orWhere('estado', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);
        return view('livewire.marketing.lw-index', compact('prospectos'));
    }
}
