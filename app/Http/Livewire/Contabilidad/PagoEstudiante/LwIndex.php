<?php

namespace App\Http\Livewire\Contabilidad\PagoEstudiante;

use App\Models\Estudiante;
use App\Models\Pago_estudiante;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class LwIndex extends Component
{
    use WithPagination;
    public $pagination = 10;
    public $attribute = '';
    public $type = 'nombre';
    public $sort = 'nombre';
    public $direction = 'desc';
    public $vacio = [];
    protected $paginationTheme = 'bootstrap';
    //Metodo de reinicio de buscador
    public function updatingAttribute()
    {
        $this->resetPage();
    }
    public function render()
    {
        $id = Pago_estudiante::all();
        $id = $id->pluck('estudiante_id')->toArray();
        $estu = Estudiante::all();
        $pago = $estu->except($id);
        if ($pago != []) {
            $estudiantes = Estudiante::where('nombre', 'ilike', '%' . $this->attribute . '%')->whereIn('id', $id)->orderBy($this->sort, $this->direction)
                ->paginate($this->pagination);
        } else {
            $estudiantes = Estudiante::where('nombre', 'ilike', '%' . $this->attribute . '%')
                ->orWhere('cedula', 'ilike', '%' . $this->attribute . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->pagination);
        }
        return view('livewire.contabilidad.pago-estudiante.lw-index', compact('estudiantes'));
    }
}