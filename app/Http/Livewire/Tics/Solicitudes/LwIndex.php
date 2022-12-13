<?php

namespace App\Http\Livewire\Tics\Solicitudes;

use App\Models\Solicitud;
use Livewire\WithPagination;
use Livewire\Component;

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
        $solicitudes = Solicitud::join('tics', 'solicituds.tic_id', '=', 'tics.id')
            ->join('users', 'solicituds.user_id', '=', 'users.id')
            ->select('solicituds.*', 'tics.nombre', 'users.name')
            ->orWhere('tics.nombre', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('users.name', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);
        return view('livewire.tics.solicitudes.lw-index', compact('solicitudes'));
    }
}
