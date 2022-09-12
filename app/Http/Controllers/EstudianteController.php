<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\EstudiantePrograma;
use App\Models\Modulo;
use App\Models\NotasPrograma;
use App\Models\Programa;
use App\Models\Requisito;
use App\Models\RequisitoArchivo;
use App\Models\RequisitoEstudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::all();
        return view('estudiante.index', compact('estudiantes'));
    }

    public function create()
    {
        $requisitos = Requisito::all();
        $programas = Programa::all();
        return view('estudiante.create', compact('requisitos', 'programas'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nombre' => 'required|string|regex:/^[\pL\s\-]+$/u|max:200',
                'email' => 'required|email|unique:estudiantes|max:200',
                'telefono' => 'required|numeric',
                'cedula' => 'required|numeric',
                'expedicion' => 'required|alpha|size:2',
                'carrera' => 'required|string|regex:/^[\pL\s\-]+$/u|max:200',
                'universidad' => 'required|string|regex:/^[\pL\s\-]+$/u|max:200',
            ],
            [
                'nombre.required' => 'El campo nombre es obligatorio',
                'nombre.string' => 'El campo nombre debe ser de tipo texto',
                'nombre.regex' => 'El campo nombre solo debe contener letras',
                'nombre.max' => 'El campo nombre debe tener máximo 100 caracteres',
                'email.required' => 'El campo email es obligatorio',
                'email.email' => 'El campo email debe ser de tipo email',
                'email.unique' => 'El email ya se encuentra registrado',
                'email.max' => 'El campo email debe tener máximo 100 caracteres',
                'telefono.required' => 'El campo teléfono es obligatorio',
                'telefono.numeric' => 'El campo teléfono debe ser de tipo numérico',
                'cedula.required' => 'El campo cédula es obligatorio',
                'cedula.numeric' => 'El campo cédula debe ser de tipo numérico',
                'expedicion.required' => 'El campo expedición es obligatorio',
                'expedicion.alpha' => 'El campo expedición solo debe contener letras',
                'expedicion.size' => 'El campo expedición debe tener 2 caracteres',
                'carrera.required' => 'El campo carrera es obligatorio',
                'carrera.string' => 'El campo carrera debe ser de tipo texto',
                'carrera.regex' => 'El campo carrera solo debe contener letras',
                'carrera.max' => 'El campo carrera debe tener máximo 100 caracteres',
                'universidad.required' => 'El campo universidad es obligatorio',
                'universidad.string' => 'El campo universidad debe ser de tipo texto',
                'universidad.regex' => 'El campo universidad solo debe contener letras',
                'universidad.max' => 'El campo universidad debe tener máximo 100 caracteres',
            ]
        );
        $estudiante = Estudiante::create($request->all());
        if ($request->id_programa) {
            EstudiantePrograma::create([
                'id_estudiante' => $estudiante->id,
                'id_programa' => $request->id_programa,
            ]);
        }
        if ($request->requisitos) {
            foreach ($request->archivo as $archivo) {
                $filename = $archivo->getClientOriginalName();
                $dir = Storage::disk('public')->put('requisitos', $archivo);
                RequisitoArchivo::create([
                    'id_estudiante' => $estudiante->id,
                    'nombre' => $filename,
                    'dir' => $dir,
                ]);
            }
            foreach ($request->requisitos as $req) {
                RequisitoEstudiante::create([
                    'id_requisito' => $req,
                    'id_estudiante' => $estudiante->id,
                    'fecha' => date('Y-m-d'),
                ]);
            }
        }
        return redirect()->route('estudiante.index', $estudiante);
    }

    public function edit(Estudiante $estudiante)
    {
        $requisitos = Requisito::all();
        $requisitosCumplidos = RequisitoEstudiante::where('id_estudiante', $estudiante->id)->get();
        $requisitosCumplidos = $requisitosCumplidos->pluck('id_requisito')->toArray();
        return view('estudiante.edit', compact('estudiante', 'requisitos', 'requisitosCumplidos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nombre' => 'required|string|regex:/^[\pL\s\-]+$/u|max:100',
                'email' => 'required|email|max:100',
                'telefono' => 'required|numeric',
                'estado' => 'required|string|regex:/^[\pL\s\-]+$/u|max:100',
                'cedula' => 'required|numeric',
                'expedicion' => 'required|alpha|size:2',
                'carrera' => 'required|string|regex:/^[\pL\s\-]+$/u|max:150',
                'universidad' => 'required|string|regex:/^[\pL\s\-]+$/u|max:150',
            ],
            [
                'nombre.required' => 'El campo nombre es obligatorio',
                'nombre.string' => 'El campo nombre debe ser de tipo texto',
                'nombre.regex' => 'El campo nombre solo debe contener letras',
                'nombre.max' => 'El campo nombre debe tener máximo 100 caracteres',
                'email.required' => 'El campo email es obligatorio',
                'email.email' => 'El campo email debe ser de tipo email',
                'email.max' => 'El campo email debe tener máximo 100 caracteres',
                'telefono.required' => 'El campo teléfono es obligatorio',
                'telefono.numeric' => 'El campo teléfono debe ser de tipo numérico',
                'estado.required' => 'El campo estado es obligatorio',
                'estado.string' => 'El campo estado debe ser de tipo texto',
                'estado.regex' => 'El campo estado solo debe contener letras',
                'estado.max' => 'El campo estado debe tener máximo 100 caracteres',
                'cedula.required' => 'El campo cédula es obligatorio',
                'cedula.numeric' => 'El campo cédula debe ser de tipo numérico',
                'expedicion.required' => 'El campo expedición es obligatorio',
                'expedicion.alpha' => 'El campo expedición solo debe contener letras',
                'expedicion.size' => 'El campo expedición debe tener 2 caracteres',
                'carrera.required' => 'El campo carrera es obligatorio',
                'carrera.string' => 'El campo carrera debe ser de tipo texto',
                'carrera.regex' => 'El campo carrera solo debe contener letras',
                'carrera.max' => 'El campo carrera debe tener máximo 150 caracteres',
                'universidad.required' => 'El campo universidad es obligatorio',
                'universidad.string' => 'El campo universidad debe ser de tipo texto',
                'universidad.regex' => 'El campo universidad solo debe contener letras',
                'universidad.max' => 'El campo universidad debe tener máximo 150 caracteres',
            ]
        );
        $estudiante = Estudiante::findOrFail($id);
        $datos = $request->all();
        $estudiante->update($datos);
        if ($request->requisitos) {

            if ($request->archivo) {
                foreach ($request->archivo as $archivo) {
                    $filename = $archivo->getClientOriginalName();
                    $dir = 'storage/' . Storage::disk('public')->put('requisitos', $archivo);
                    RequisitoArchivo::create([
                        'id_estudiante' => $estudiante->id,
                        'nombre' => $filename,
                        'dir' => $dir,
                    ]);
                }
            }
            $data = [];
            foreach ($request->requisitos as $requisito) {
                array_push(
                    $data,
                    [
                        "id_requisito" => $requisito,
                        "fecha" => date('Y-m-d')
                    ]
                );
            }
            $estudiante->requisitos()->sync($data);
        }
        return redirect()->route('estudiante.index');
    }

    public function destroy($modulo)
    {
        $estudiante = Estudiante::findOrFail($modulo);
        $estudiante->delete();
        return back()->with('mensaje', 'Eliminado Correctamente');
    }

    public function show($idEstudiante)
    {
        $estudiante = Estudiante::findOrFail($idEstudiante);
        $documentos = RequisitoArchivo::where('id_estudiante', $idEstudiante)->get();
        $requisitos = RequisitoEstudiante::where('id_estudiante', $idEstudiante)->get();
        $requisitosID = $requisitos->pluck('id_requisito')->toArray();
        $requisitosFaltantes = Requisito::whereNotIn('id', $requisitosID)->get();
        $Idprogramas = EstudiantePrograma::where('id_estudiante', $idEstudiante)->get();
        $programas = Programa::whereIn('id', $Idprogramas->pluck('id_programa')->toArray())->get();
        return view('estudiante.show', compact('estudiante', 'documentos', 'requisitos', 'requisitosFaltantes', 'programas'));
    }

    public function newprogram($estudiante)
    {
        $estudiante = Estudiante::findOrFail($estudiante);
        $programaEstudiante = EstudiantePrograma::where('id_estudiante', $estudiante->id)->get();
        $idProgramas = $programaEstudiante->pluck('id_programa')->toArray();
        $programas = Programa::whereNotIn('id', $idProgramas)->get();
        return view('estudiante.newprogram', compact('estudiante', 'programas'));
    }

    public function storenewprogram(Request $request, $estudiante)
    {
        EstudiantePrograma::create([
            'id_estudiante' => $estudiante,
            'id_programa' => $request->id_programa,
        ]);
        return redirect()->route('estudiante.show', $estudiante);
    }

    public function showNotas($estudiante, $programa)
    {
        $estudiante = Estudiante::findOrFail($estudiante);
        $programa = Programa::findOrFail($programa);
        $notas = NotasPrograma::where('id_estudiante', $estudiante->id)
            ->where('id_programa', $programa->id)->get();
        return view('estudiante.notas', compact('estudiante', 'programa', 'notas'));
    }
}
