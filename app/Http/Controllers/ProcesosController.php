<?php

namespace App\Http\Controllers;

use App\Models\ProcesoModulo;
use Illuminate\Http\Request;

class ProcesosController extends Controller
{
    // Ver los procesos
    public function index()
    {
        return view('procesos.index');
    }

    // Interface para crear un procesos
    public function create()
    {
        return view('procesos.create');
    }

    // Guardar un procesos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
        ], [
            'nombre.required' => 'El nombre es requerido',
            'nombre.string' => 'El nombre debe ser una cadena de texto',
        ]);
        // ultimo proceso credao
        $ultimoProceso = ProcesoModulo::orderBy('orden', 'desc')->first();
        $lastPosition = 0;
        $ultimoProceso ? $lastPosition = $ultimoProceso->orden : $lastPosition = 0;
        $request->merge(['orden' => $lastPosition + 1]);
        ProcesoModulo::create($request->all());
        return redirect()->route('procesos.index');
    }

    // Interface de edición de un procesos
    public function edit($id)
    {
        $proceso = ProcesoModulo::findOrFail($id);
        return view('procesos.edit', compact('proceso'));
    }

    // Actualizar un procesos
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
        ], [
            'nombre.required' => 'El nombre es requerido',
            'nombre.string' => 'El nombre debe ser una cadena de texto',
        ]);
        $proceso = ProcesoModulo::findOrFail($id);
        $proceso->update($request->all());
        return redirect()->route('procesos.index');
    }

    // Eliminar un procesos
    public function destroy($id)
    {
        $proceso = ProcesoModulo::findOrFail($id);
        $proceso->delete();
        return redirect()->route('procesos.index');
    }
}
