<?php

namespace App\Http\Livewire\Administracion\Activos;

use App\Models\ActivoFijo;
use Livewire\Component;
use Livewire\WithPagination;

class LwIndex extends Component
{
    use WithPagination;
    public $pagination = 20;
    public $attribute = '';
    public $type = 'codigo';
    public $sort = 'codigo';
    public $direction = 'desc';

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
            ->where('tipo', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('codigo', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('descripcion', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('unidad', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('estado', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('users.name', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('area.nombre', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);
        return view('livewire.administracion.activos.lw-index', compact('activos'));
    }
}
