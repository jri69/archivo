<?php

namespace App\Http\Livewire\Academico\Estudiante;

use App\Models\Carrera;
use App\Models\Estudiante;
use App\Models\Requisito;
use App\Models\RequisitoEstudiante;
use App\Models\Universidad;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class LwEdit extends Component
{
    use WithFileUploads;
    public $datos = [];
    public $documentos = [];
    public $estudiante;
    public $carreras = [];
    public $universidades = [];
    public $foto;

    public function mount($id_estudiante)
    {
        $this->estudiante = Estudiante::find($id_estudiante);
        $this->datos['nombre'] = $this->estudiante->nombre;
        $this->datos['cedula'] = $this->estudiante->cedula;
        $this->datos['telefono'] = $this->estudiante->telefono;
        $this->datos['email'] = $this->estudiante->email;
        $this->datos['expedicion'] = $this->estudiante->expedicion;
        $this->datos['nacionalidad'] = $this->estudiante->nacionalidad;
        $this->datos['carrera'] = $this->estudiante->carrera;
        $this->datos['universidad'] = $this->estudiante->universidad;
        $this->datos['numero_registro'] = $this->estudiante->numero_registro;
        $this->datos['sexo'] = $this->estudiante->sexo;
        $this->datos['honorifico'] = $this->estudiante->honorifico;
        $this->carreras = Carrera::all();
        $this->universidades = Universidad::all();
    }

    public function store()
    {
        $this->validate(
            [
                'datos.nombre' => 'required|string|max:200',
                'datos.email' => 'required|email|max:200|unique:estudiantes,email,' . $this->estudiante->id,
                'datos.telefono' => 'numeric',
                'datos.cedula' => 'required|unique:estudiantes,cedula,' . $this->estudiante->id,
                'datos.expedicion' => 'required|alpha|size:2',
                'datos.carrera' => 'required|string|max:200',
                'datos.universidad' => 'required|string|max:200',
                'datos.numero_registro' => 'nullable|string|max:200',
                'datos.nacionalidad' => 'required|string',
                'datos.honorifico' => 'required|string',
                'datos.sexo' => 'required|string',
                'foto' => 'nullable|image',
            ],
            [
                'datos.nombre.required' => 'El campo nombre es obligatorio',
                'datos.nombre.regex' => 'El campo nombre solo puede contener letras',
                'datos.email.required' => 'El campo correo es obligatorio',
                'datos.email.email' => 'El campo correo debe ser un correo valido',
                'datos.email.unique' => 'El campo correo ya esta registrado',
                'datos.telefono.numeric' => 'El campo telefono solo puede contener numeros',
                'datos.cedula.required' => 'El campo cedula es obligatorio',
                'datos.expedicion.required' => 'El campo expedicion es obligatorio',
                'datos.expedicion.alpha' => 'El campo expedicion solo puede contener letras',
                'datos.expedicion.size' => 'El campo expedicion debe tener 2 caracteres',
                'datos.carrera.required' => 'El campo carrera es obligatorio',
                'datos.carrera.regex' => 'El campo carrera solo puede contener letras',
                'datos.universidad.required' => 'El campo universidad es obligatorio',
                'datos.universidad.regex' => 'El campo universidad solo puede contener letras',
                'datos.numero_registro.required' => 'El campo numero de registro es obligatorio',
                'datos.nacionalidad.required' => 'El campo nacionalidad es obligatorio',
                'datos.honorifico.required' => 'El campo honorifico es obligatorio',
                'datos.sexo.required' => 'El campo sexo es obligatorio',
                'foto.image' => 'El campo foto debe ser una imagen',
            ]
        );
        if ($this->foto) {
            $filename = $this->foto->getClientOriginalName();
            $this->datos['foto'] = 'storage/' . Storage::disk('public')->put('estudiantes', $this->foto);
            if ($this->estudiante->foto && $this->estudiante->foto != 'person_default.webp') {
                unlink($this->estudiante->foto);
            }
        }
        $this->estudiante->update($this->datos);
        if ($this->documentos) {
            $requisitos = Requisito::all();
            foreach ($requisitos as $requisito) {
                if (array_key_exists($requisito->id, $this->documentos)) {
                    $archivo = $this->documentos[$requisito->id];
                    $filename = $archivo->getClientOriginalName();
                    $dir = 'storage/' . Storage::disk('public')->put('requisitos', $archivo);
                    RequisitoEstudiante::create([
                        'nombre' => $filename,
                        'dir' => $dir,
                        'fecha' => date('Y-m-d'),
                        'id_estudiante' => $this->estudiante->id,
                        'id_requisito' => $requisito->id,
                    ]);
                }
            }
        }
        return redirect()->route('estudiante.index', $this->estudiante);
    }

    public function render()
    {
        $entregados = RequisitoEstudiante::where('id_estudiante', $this->estudiante->id)->get();
        $entregados_id = $entregados->pluck('id_requisito')->toArray();
        $requisitos = Requisito::whereNotIn('id', $entregados_id)->get();
        return view('livewire.academico.estudiante.lw-edit', compact('requisitos'));
    }
}
