<?php

namespace App\Http\Livewire\Academico\Proceso;

use App\Models\ProcesoModulo;
use Livewire\Component;
use Livewire\WithPagination;

class LwIndex extends Component
{
    use WithPagination;
    public $pagination = 20;
    public $attribute = '';
    public $type = 'id';
    public $sort = 'orden';
    public $direction = 'asc';
    protected $paginationTheme = 'bootstrap';

    //Metodo de reinicio de buscador
    public function updatingAttribute()
    {
        $this->resetPage();
    }

    public function subirNivel($id)
    {
        $proceso = ProcesoModulo::findOrFail($id);
        if ($proceso->orden != 1) {
            $antProceso = ProcesoModulo::where('orden', $proceso->orden - 1)->first();
            $proceso->orden = $proceso->orden - 1;
            $proceso->save();
            $antProceso->orden = $antProceso->orden + 1;
            $antProceso->save();
            $this->render();
        }
    }

    public function bajarNivel($id)
    {
        $proceso = ProcesoModulo::findOrFail($id);
        $ultimoProceso = ProcesoModulo::orderBy('orden', 'desc')->first();
        if ($proceso->orden != $ultimoProceso->orden) {
            $sigProceso = ProcesoModulo::where('orden', $proceso->orden + 1)->first();
            $proceso->orden = $proceso->orden + 1;
            $proceso->save();
            $sigProceso->orden = $sigProceso->orden - 1;
            $sigProceso->save();
            $this->render();
        }
    }

    public function render()
    {
        $procesos = ProcesoModulo::where('nombre', 'ILIKE', '%' . strtolower($this->attribute) . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);
        return view('livewire.academico.proceso.lw-index', compact('procesos'));
    }
}
