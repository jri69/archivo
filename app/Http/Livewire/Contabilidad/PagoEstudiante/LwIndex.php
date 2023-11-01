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


    public function updatingAttribute()
    {
        $this->resetPage();
    }

    public function render()
    {
        $estudiantes = Estudiante::where($this->type, 'like', '%' . $this->attribute . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);
        return view('livewire.contabilidad.pago-estudiante.lw-index', compact('estudiantes'));
    }
}
