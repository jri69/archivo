<?php

namespace App\Http\Livewire\Documentos\Documentos;

use App\Models\Documento;
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
        $documentos = Documento::join('movimiento_docs', 'movimiento_docs.id', '=', 'documentos.movimiento_doc_id')
            ->join('recepcions', 'recepcions.id', '=', 'documentos.recepcion_id')
            ->select('documentos.*', 'recepcions.*', 'movimiento_docs.*')
            ->orWhere('recepcions.codigo', 'like', '%' . $this->attribute . '%')
            ->orWhere('movimiento_docs.codigo', 'like', '%' . $this->attribute . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->pagination);
        return view('livewire..documentos.documentos.lw-index', compact('documentos'));
    }
}
