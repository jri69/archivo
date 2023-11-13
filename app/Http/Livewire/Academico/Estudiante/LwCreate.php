<?php

namespace App\Http\Livewire\Academico\Estudiante;

use App\Models\Carrera;
use App\Models\Estudiante;
use App\Models\EstudianteModulo;
use App\Models\EstudiantePrograma;
use App\Models\Modulo;
use App\Models\NotasPrograma;
use App\Models\Programa;
use App\Models\Requisito;
use App\Models\RequisitoEstudiante;
use App\Models\Universidad;
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
    public $listModulos = [];
    public $universidades;
    public $carreras;
    public $foto;

    public function mount()
    {
        $this->datos['nombre'] = '';
        $this->datos['honorifico'] = '';
        $this->datos['sexo'] = 'M';
        $this->datos['cedula'] = '';
        $this->datos['telefono'] = '';
        $this->datos['email'] = '';
        $this->datos['expedicion'] = '';
        $this->datos['estado'] = 'Activo';
        $this->datos['id_modulo'] = '';
        $this->datos['id_programa'] = '';
        $this->datos['numero_registro'] = '';
        $this->datos['universidad'] = '';
        $this->datos['carrera'] = '';
        $this->datos['nacionalidad'] = 'Boliviano';
        $date = date('Y-m-d');
        $this->programas = Programa::orWhere('fecha_finalizacion', '>=', $date)
            ->orWhere('has_editable', 'Si')
            ->get();
        $this->requisitos = Requisito::all();
        $this->universidades = Universidad::all();
        $this->carreras = Carrera::all();
    }

    public function store()
    {
        $this->validate(
            [
                'datos.nombre' => 'required|string|max:200',
                'datos.email' => 'email|max:200|unique:estudiantes,email',
                'datos.telefono' => 'numeric',
                'datos.cedula' => 'required|unique:estudiantes,cedula',
                'datos.expedicion' => 'required|alpha|size:2',
                'datos.carrera' => 'required|string|max:200',
                'datos.universidad' => 'required|string|max:200',
                'datos.numero_registro' => 'numeric',
                'datos.nacionalidad' => 'required|string',
                'datos.honorifico' => 'required|string',
                'datos.sexo' => 'required|string',
                'foto' => 'required|image',
            ],
            [
                'datos.nombre.required' => 'El campo nombre es obligatorio',
                'datos.nombre.regex' => 'El campo nombre solo puede contener letras',
                'datos.email.email' => 'El campo correo debe ser un correo valido',
                'datos.email.unique' => 'El campo correo ya esta registrado',
                'datos.telefono.numeric' => 'El campo telefono solo puede contener numeros',
                'datos.cedula.numeric' => 'El campo cedula solo puede contener numeros',
                'datos.expedicion.required' => 'El campo expedicion es obligatorio',
                'datos.expedicion.alpha' => 'El campo expedicion solo puede contener letras',
                'datos.expedicion.size' => 'El campo expedicion debe tener 2 caracteres',
                'datos.carrera.required' => 'El campo carrera es obligatorio',
                'datos.carrera.regex' => 'El campo carrera solo puede contener letras',
                'datos.universidad.required' => 'El campo universidad es obligatorio',
                'datos.universidad.regex' => 'El campo universidad solo puede contener letras',
                'datos.numero_registro.numeric' => 'El campo numero de registro solo puede contener numeros',
                'datos.nacionalidad.required' => 'El campo nacionalidad es obligatorio',
                'datos.honorifico.required' => 'El campo honorifico es obligatorio',
                'datos.sexo.required' => 'El campo sexo es obligatorio',
            ]
        );
        $this->datos['foto'] = 'storage/' . Storage::disk('public')->put('estudiantes', $this->foto);
        $estudiante = Estudiante::create($this->datos);
        if ($this->datos['id_programa']) {
            EstudiantePrograma::create([
                'id_estudiante' => $estudiante->id,
                'id_programa' => $this->datos['id_programa'],
            ]);
            EstudianteModulo::create([
                'id_estudiante' => $estudiante->id,
                'id_modulo' => $this->datos['id_modulo'],
            ]);
            NotasPrograma::create([
                'id_estudiante' => $estudiante->id,
                'id_programa' => $this->datos['id_programa'],
                'id_modulo' => $this->datos['id_modulo'],
                'nota' => 0,
                'observaciones' => '',
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
        if ($this->datos['id_programa'] != '') {
            $this->listModulos = Modulo::where('programa_id', $this->datos['id_programa'])->get();
        } else {
            $this->listModulos = [];
        }
        return view('livewire.academico.estudiante.lw-create');
    }
}
