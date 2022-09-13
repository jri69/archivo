<?php

namespace App\Http\Livewire\Documentos\Movimiento;

use App\Models\Documento;
use App\Models\MovimientoDoc;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class LwCreate extends Component
{
    use WithFileUploads;
    public $recepcion;
    public $hasDocument;

    public $datos = [];

    public function mount()
    {
        $this->datos['user_id'] = "";
        $this->datos['tipo'] = "";
        $this->datos['fecha'] = "";
        $this->datos['departamento'] = "";
        $this->datos['codigo'] = "";
        $this->datos['documento'] = [];
        $this->datos['descripcion'] = "";
    }

    public function save()
    {
        $this->validate([
            'datos.user_id' => 'required',
            'datos.fecha' => 'required',
            'datos.departamento' => 'required|max:255',
            'datos.codigo' => 'required|max:255',
            'datos.descripcion' => 'required|max:300',
        ], [
            'datos.codigo.required' => 'El campo código es obligatorio',
            'datos.user_id.required' => 'El campo usuario es obligatorio',
            'datos.fecha.required' => 'El campo fecha es obligatorio',
            'datos.departamento.required' => 'El campo departamento es obligatorio',
            'datos.descripcion.required' => 'El campo descripción es obligatorio',
            'datos.departamento.max' => 'El campo departamento debe contener maximo 255 caracteres',
            'datos.codigo.max' => 'El campo código debe contener maximo 255 caracteres',
            'datos.descripcion.max' => 'El campo descripción debe contener maximo 300 caracteres',
        ]);
        if ($this->datos['tipo'] != "" || $this->datos['documento'] != null) {
            $this->validate([
                'datos.tipo' => 'required',
                'datos.documento' => 'required',
            ], [
                'datos.tipo.required' => 'El campo tipo es obligatorio',
                'datos.documento.required' => 'El campo documento es obligatorio',
            ]);
        }

        $movimiento = MovimientoDoc::create([
            'codigo' => $this->datos['codigo'],
            'recepcion_id' => $this->recepcion->id,
            'user_id' => $this->datos['user_id'],
            'fecha' => $this->datos['fecha'],
            'departamento' => $this->datos['departamento'],
            'descripcion' => $this->datos['descripcion'],
        ]);

        if ($this->datos['tipo'] != "" && $this->datos['documento'] != null) {
            foreach ($this->datos['documento'] as $doc) {
                $filename = $doc->getClientOriginalName();
                $dir = 'storage/' . Storage::disk('public')->put('Recepcion', $doc);
                Documento::create([
                    'nombre' => $filename,
                    'dir' => $dir,
                    'tipo' => $this->datos['tipo'],
                    'movimiento_doc_id' => $movimiento->id,
                ]);
            }
        }

        return redirect()->route('recepcion.show', $this->recepcion->id);
    }

    public function render()
    {
        $usuarios = User::all();
        return view('livewire..documentos.movimiento.lw-create', compact('usuarios'));
    }
}
