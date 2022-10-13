<?php

namespace App\Http\Livewire\Contrataciones\Contrataciones;

use App\Models\Contrato;
use Livewire\Component;
use Livewire\WithPagination;

class LwIndex extends Component
{
    use WithPagination;
    public $pagination = 20;
    public $attribute = '';
    public $sort = 'contratos.id';
    public $direction = 'desc';
    protected $paginationTheme = 'bootstrap';

    //Metodo de reinicio de buscador
    public function updatingAttribute()
    {
        $this->resetPage();
    }

    public function render()
    {
        $contratos = Contrato::join('modulos', 'modulos.id', '=', 'contratos.modulo_id')
            ->join('docentes', 'docentes.id', '=', 'modulos.docente_id')
            ->select('contratos.*', 'modulos.* as modulo', 'docentes.* as docente', 'contratos.id as contrato_id')
            ->orWhere('contratos.fecha_inicio', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('contratos.fecha_final', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('modulos.nombre', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('docentes.nombre', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('docentes.apellido', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orWhere('docentes.cedula', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);
        return view('livewire.contrataciones.contrataciones.lw-index', compact('contratos'));
    }
}
