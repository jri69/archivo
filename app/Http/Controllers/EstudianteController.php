<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
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
        return view('estudiante.create');
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
