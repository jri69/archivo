<?php

namespace App\Http\Livewire\Academico\Modulo;

use App\Models\Modulo;
use Livewire\Component;
use Livewire\WithPagination;

class LwIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $modulos = Modulo::paginate(15);
        return view('livewire..academico.modulo.lw-index', compact('modulos'));
    }
}
