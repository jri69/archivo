<?php

namespace App\Http\Livewire\Administracion\Activos;

use App\Models\ActivoFijo;
use Livewire\Component;
use Livewire\WithPagination;

class LwIndex extends Component
{
    use WithPagination;
    public $pagination = 10;
    public $attribute = '';
    public $type = 'codigo';
    public $sort = 'codigo';
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
        $activos = ActivoFijo::join('users', 'users.id', '=', 'activo_fijos.id_usuario')
            ->join('area', 'area.id', '=', 'activo_fijos.id_area')
            ->select('activo_fijos.*', 'users.name', 'area.nombre')
            ->where('tipo', 'like', '%' . $this->attribute . '%')
            ->orWhere('codigo', 'like', '%' . $this->attribute . '%')
            ->orWhere('descripcion', 'like', '%' . $this->attribute . '%')
            ->orWhere('unidad', 'like', '%' . $this->attribute . '%')
            ->orWhere('estado', 'like', '%' . $this->attribute . '%')
            ->orWhere('users.name', 'like', '%' . $this->attribute . '%')
            ->orWhere('area.nombre', 'like', '%' . $this->attribute . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);
        return view('livewire.administracion.activos.lw-index', compact('activos'));
    }
}
