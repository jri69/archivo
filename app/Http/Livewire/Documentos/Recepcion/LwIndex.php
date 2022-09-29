<?php

namespace App\Http\Livewire\Documentos\Recepcion;

use App\Models\Recepcion;
use Livewire\Component;
use Livewire\WithPagination;

class LwIndex extends Component
{
    use WithPagination;
    public $pagination = 10;
    public $attribute = '';
    public $type = 'id';
    public $sort = 'id';
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
        //$recepciones = Recepcion::all();
        $recepciones = Recepcion::join('users', 'recepcions.user_id', '=', 'users.id')
            ->join('usuarios', 'users.usuario_id', '=', 'usuarios.id')
            ->join('unidad_organizacionals', 'recepcions.unidad_organizativa_id', '=', 'unidad_organizacionals.id')
            ->select('recepcions.*', 'usuarios.nombre as nombre_usuario', 'unidad_organizacionals.nombre as nombre_unidad_organizativa')
            ->orWhere('recepcions.fecha', 'like', '%' . strtolower($this->attribute) . '%')
            ->orWhere('recepcions.codigo', 'like', '%' . strtolower($this->attribute) . '%')
            ->orWhere('usuarios.nombre', 'like', '%' . strtolower($this->attribute) . '%')
            ->orWhere('unidad_organizacionals.nombre', 'like', '%' . strtolower($this->attribute) . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);
        return view('livewire..documentos.recepcion.lw-index', compact('recepciones'));
    }
}
