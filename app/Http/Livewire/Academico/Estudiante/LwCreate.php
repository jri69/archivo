<?php

namespace App\Http\Livewire\Academico\Estudiante;

use App\Models\Estudiante;
use App\Models\EstudiantePrograma;
use App\Models\Programa;
use App\Models\Requisito;
use App\Models\RequisitoEstudiante;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class LwCreate extends Component
{
    use WithFileUploads;
    public $datos = [];
    public $documentos = [];
    public $programas;
    public $requisitos;

    public function mount()
    {
        $this->datos['nombre'] = '';
        $this->datos['apellido'] = '';
        $this->datos['cedula'] = '';
        $this->datos['telefono'] = '';
        $this->datos['email'] = '';
        $this->datos['expedicion'] = '';
        $this->datos['estado'] = '';
        $this->datos['id_programa'] = '';
        // pedir todos los programas que aun estan en fechas de finalizacion disponible
        $date = date('Y-m-d');
        $this->programas = Programa::where('fecha_finalizacion', '>=', $date)->get();
        $this->requisitos = Requisito::all();
    }

    public function store()
    {
        $this->validate(
            [
                'datos.nombre' => 'required|string|regex:/^[\pL\s\-]+$/u|max:200',
                'datos.email' => 'required|email|max:200|unique:estudiantes,email',
                'datos.telefono' => 'required|numeric',
                'datos.cedula' => 'required|numeric|unique:estudiantes,cedula',
                'datos.expedicion' => 'required|alpha|size:2',
                'datos.carrera' => 'required|string|regex:/^[\pL\s\-]+$/u|max:200',
                'datos.universidad' => 'required|string|regex:/^[\pL\s\-]+$/u|max:200',
                'datos.id_programa' => 'required|numeric',
            ],
            [
                'datos.nombre.required' => 'El campo nombre es obligatorio',
                'datos.nombre.regex' => 'El campo nombre solo puede contener letras',
                'datos.email.required' => 'El campo correo es obligatorio',
                'datos.email.email' => 'El campo correo debe ser un correo valido',
                'datos.email.unique' => 'El campo correo ya esta registrado',
                'datos.telefono.required' => 'El campo telefono es obligatorio',
                'datos.telefono.numeric' => 'El campo telefono solo puede contener numeros',
                'datos.cedula.required' => 'El campo cedula es obligatorio',
                'datos.cedula.numeric' => 'El campo cedula solo puede contener numeros',
                'datos.expedicion.required' => 'El campo expedicion es obligatorio',
                'datos.expedicion.alpha' => 'El campo expedicion solo puede contener letras',
                'datos.expedicion.size' => 'El campo expedicion debe tener 2 caracteres',
                'datos.carrera.required' => 'El campo carrera es obligatorio',
                'datos.carrera.regex' => 'El campo carrera solo puede contener letras',
                'datos.universidad.required' => 'El campo universidad es obligatorio',
                'datos.universidad.regex' => 'El campo universidad solo puede contener letras',
                'datos.id_programa.required' => 'El campo programa es obligatorio',
            ]
        );
        $estudiante = Estudiante::create([
            'nombre' => $this->datos['nombre'],
            'email' => $this->datos['email'],
            'estado' => $this->datos['estado'],
            'telefono' => $this->datos['telefono'],
            'cedula' => $this->datos['cedula'],
            'expedicion' => $this->datos['expedicion'],
            'carrera' => $this->datos['carrera'],
            'universidad' => $this->datos['universidad'],
        ]);
        if ($this->datos['id_programa']) {
            EstudiantePrograma::create([
                'id_estudiante' => $estudiante->id,
                'id_programa' => $this->datos['id_programa'],
            ]);
        }
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
                        'id_estudiante' => $estudiante->id,
                        'id_requisito' => $requisito->id,
                    ]);
                }
            }
        }
        return redirect()->route('estudiante.index', $estudiante);
    }

    public function render()
    {
        return view('livewire.academico.estudiante.lw-create');
    }
}
