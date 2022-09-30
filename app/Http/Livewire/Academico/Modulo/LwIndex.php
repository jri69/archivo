<?php

namespace App\Http\Livewire\Academico\Modulo;

use App\Models\Modulo;
use Livewire\Component;
use Livewire\WithPagination;

class LwIndex extends Component
{
    use WithPagination;
<<<<<<< HEAD
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $modulos = Modulo::paginate(15);
=======
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
        $modulos = Modulo::where('nombre', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('fecha_inicio', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('fecha_final', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);
>>>>>>> master
        return view('livewire..academico.modulo.lw-index', compact('modulos'));
    }
}
