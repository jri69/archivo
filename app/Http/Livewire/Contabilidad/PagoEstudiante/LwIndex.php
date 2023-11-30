<?php

namespace App\Http\Livewire\Contabilidad\PagoEstudiante;

use App\Models\Estudiante;
use App\Models\Pago_estudiante;
use Livewire\Component;
use Livewire\WithPagination;

class LwIndex extends Component
{
    use WithPagination;
    public $pagination = 10;
    public $attribute = '';
    public $type = 'nombre';
    public $sort = 'nombre';
    public $direction = 'desc';
    protected $paginationTheme = 'bootstrap';
    public $estudiantes;
    private $estudiantes_all;
    public $filtro = 'todos';

    public function updatingAttribute()
    {
        $this->resetPage();
    }

    public function todos()
    {
        $this->filtro = 'todos';
    }

    public function conDeuda()
    {
        $this->filtro = 'con_deuda';
    }

    public function render()
    {
        $estudantes_search = Estudiante::where($this->type, 'ilike', '%' . $this->attribute . '%')
            ->orWhere('cedula', 'ilike', '%' . $this->attribute . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);
        foreach ($estudantes_search as $key => $estudiante) {
            $pago_estudiantes = Pago_estudiante::where('estudiante_id', $estudiante->id)->get();
            $hasDeuda = false;
            foreach ($pago_estudiantes as $key => $pago_estudiante) {
                Pago_estudiante::calcularEstadoDeuda($pago_estudiante);
                if ($pago_estudiante->estado == 'CON DEUDA') {
                    $hasDeuda = true;
                    break;
                }
            }
            if ($hasDeuda) {
                $estudiante->deuda = 'CON DEUDA';
            } else {
                $estudiante->deuda = 'SIN DEUDA';
            }
        }
        if ($this->filtro == 'con_deuda') {
            $estudantes_search = $estudantes_search->where('deuda', 'CON DEUDA');
        } else if ($this->filtro == 'sin_deuda') {
            $estudantes_search = $estudantes_search->where('deuda', 'SIN DEUDA');
        }

        // $estudantes_search = Estudiante::join('pago_estudiante', 'estudiantes.id', '=', 'pago_estudiante.estudiante_id')
        //     ->select('estudiantes.*, pago_estudiante.estado as deuda')
        //     ->where('pago_estudiante.estado', $this->filtro)
        //     ->where(function ($query) {
        //         $query->where('estudiantes.nombre', 'ilike', '%' . $this->attribute . '%')
        //             ->orWhere('estudiantes.cedula', 'ilike', '%' . $this->attribute . '%');
        //     })
        //     ->orderBy($this->sort, $this->direction)
        //     ->paginate($this->pagination);
        return view('livewire.contabilidad.pago-estudiante.lw-index', compact('estudantes_search'));
    }
}
