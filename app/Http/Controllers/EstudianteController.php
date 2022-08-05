<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\EstudiantePrograma;
use App\Models\Modulo;
use App\Models\Programa;
use App\Models\Requisito;
use App\Models\RequisitoEstudiante;
use Illuminate\Http\Request;

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
        $request->validate([
            'nombre' => 'required',
            'email' => 'required',
            'telefono' => 'required',
            'cedula' => 'required',
            'carrera' => 'required',
            'universidad' => 'required',
        ]);
        $estudiante = Estudiante::create($request->all());
        if ($request->id_programa) {
            EstudiantePrograma::create([
                'id_estudiante' => $estudiante->id,
                'id_programa' => $request->id_programa,
            ]);
        }
        if ($request->requisitos) {
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
        return view('estudiante.edit', compact('estudiante'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required',
            'telefono' => 'required',
            'cedula' => 'required',
            'carrera' => 'required',
            'universidad' => 'required',
        ]);
        $estudiante = Estudiante::findOrFail($id);
        $datos = $request->all();
        $estudiante->update($datos);
        return redirect()->route('estudiante.index');
    }

    public function destroy($modulo)
    {
        $estudiante = Estudiante::findOrFail($modulo);
        $estudiante->delete();
        return back()->with('mensaje', 'Eliminado Correctamente');
    }
}
